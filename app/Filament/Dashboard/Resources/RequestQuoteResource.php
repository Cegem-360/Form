<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Enums\ClientType;
use App\Filament\Dashboard\Resources\RequestQuoteResource\Pages\ListRequestQuotes;
use App\Filament\Dashboard\Resources\RequestQuoteResource\Pages\ViewRequestQuote;
use App\Filament\Dashboard\Resources\RequestQuoteResource\Widgets\RequestQuotePriceWidget;
use App\Models\RequestQuote;
use App\Models\WebsiteLanguage;
use BackedEnum;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Number;

final class RequestQuoteResource extends Resource
{
    protected static ?string $model = RequestQuote::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): ?string
    {
        return __('filament::resources/pages/request-quote.navigation.group');
    }

    public static function getModelLabel(): string
    {
        return __('Request Quote');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Request Quotes');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    TextInput::make('quotation_name')
                        ->maxLength(255),
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->required()
                        ->email()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->required()
                        ->tel()
                        ->maxLength(255),
                    RichEditor::make('project_description')
                        ->maxLength(65535)
                        ->columnSpanFull(),
                    TextInput::make('payment_method')
                        ->disabled()
                        ->maxLength(255),
                    Select::make('client_type')
                        ->required()
                        ->options(ClientType::class)
                        ->preload()
                        ->searchable(),
                    TextInput::make('company_name')
                        ->maxLength(255),
                    TextInput::make('company_address')
                        ->maxLength(255),
                    Select::make('website_type_id')
                        ->live()
                        ->required()
                        ->relationship('websiteType', 'name')
                        ->afterStateUpdated(function (Set $set): void {
                            $set('request_quote_functionalities', []);
                        })
                        ->searchable(),
                    Select::make('website_engine')
                        ->live()
                        ->options([
                            'wordpress' => 'Wordpress',
                            'laravel' => 'Laravel',
                            'shopify' => 'Shopify',
                        ])->required()
                        ->searchable(),
                ]),
                Grid::make(1)->schema([
                    Repeater::make('websites')->schema([
                        Grid::make(1)->columnSpan(1)->schema([
                            TextInput::make('name')
                                ->required(),
                            ToggleButtons::make('required')
                                ->live()
                                ->boolean(trueLabel: __('Yes'), falseLabel: __('No'))
                                ->inline()
                                ->required(),
                            ToggleButtons::make('length')
                                ->label('Content length')
                                ->live()
                                ->options([
                                    'short' => __('Short'),
                                    'medium' => __('Medium'),
                                    'large' => __('Large'),
                                ])
                                ->inline()
                                ->afterStateUpdated(function ($state, Set $set, Get $get): void {
                                    $set('image', match ($state) {
                                        'short' => 'website_previews/short_preview.png',
                                        'medium' => 'website_previews/medium_preview.png',
                                        'large' => 'website_previews/large_preview.png',
                                        default => null,
                                    });
                                })
                                ->required(fn ($get) => $get('required')),

                            FileUpload::make('images')
                                ->visible(fn ($get) => $get('required'))
                                ->disk('public')
                                ->directory('website-images')
                                ->openable()
                                ->downloadable()
                                ->reorderable()
                                ->maxFiles(10)
                                ->acceptedFileTypes(['jpg', 'jpeg', 'png', 'gif'])
                                ->helperText(__('You can upload multiple images'))
                                ->columnSpanFull(),

                        ]),

                    ]),

                ]),
                Grid::make(1)->schema([
                    Toggle::make('have_website_graphic')
                        ->default(false)
                        ->label('Do you have a website graphic?')
                        ->disabled(),
                    Actions::make([
                        Action::make('yes')
                            ->hidden()
                            ->requiresConfirmation()
                            ->modalHeading(__('Website graphic'))
                            ->modalDescription(__("Are you sure you'd have website graphic form UI/UX designer?"))
                            ->modalSubmitActionLabel(__('Yes, I have a website graphic'))
                            ->modalAlignment(Alignment::Center)
                            ->action(function (Set $set): void {
                                $set('have_website_graphic', true);
                            }),
                        Action::make('no')
                            ->hidden()
                            ->requiresConfirmation()
                            ->modalHeading(__('Website graphic'))
                            ->modalDescription(__("Are you sure you'd have website graphic form UI/UX designer?"))
                            ->modalSubmitActionLabel("No, I don't have a website graphic")
                            ->modalAlignment(Alignment::Center)
                            ->action(function (Set $set): void {
                                $set('have_website_graphic', false);
                            }),
                    ])->label('Do you have a website graphic?'),
                ]),
                CheckboxList::make('request_quote_functionalities')
                    ->relationship(name: 'requestQuoteFunctionalities', modifyQueryUsing: function (Get $get, Builder $query) {
                        return $query->where('website_type_id', $get('website_type_id'));
                    })
                    ->getOptionLabelFromRecordUsing(fn (Model $record): string => __($record->name)),
                Toggle::make('is_multilangual')
                    ->live(),
                Select::make('default_language')
                    ->live()
                    ->visible(fn ($get) => $get('is_multilangual'))
                    ->default(WebsiteLanguage::whereName('Hungarian')->firstOrCreate(['name' => 'Hungarian'])->id)
                    ->options(WebsiteLanguage::all()->pluck('name', 'id'))
                    ->afterStateUpdated(function (Set $set): void {
                        $set('languages', []);
                    })
                    ->searchable(),
                Select::make('languages')
                    ->multiple()
                    ->visible(fn ($get) => $get('is_multilangual'))
                    ->options(function (Get $get) {
                        return WebsiteLanguage::whereNot('id', '=', $get('default_language'))->pluck('name', 'id');
                    })
                    ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();
        $userId = $user->id;

        return $table
            ->modifyQueryUsing(function (Builder $query) use ($userId) {
                return $query->whereUserId($userId);
            })
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('quotation_name')
                    ->searchable(),
                TextColumn::make('websiteType.name')
                    ->sortable(),
                TextColumn::make('website_engine')
                    ->sortable(),
                IconColumn::make('is_multilangual')
                    ->boolean(),
                TextColumn::make('price')
                    ->label('Deposit Price')
                    ->state(function (Model $record): string|false {
                        return Number::currency($record->getTotalPriceAttribute() / 2, 'HUF', 'hu_HU', 0);
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                Action::make('order')
                    ->label(__('Order'))
                    ->action(function (RequestQuote $record) {
                        Session::put('requestQuote', $record->id);

                        return redirect()->route('cart.summary', ['requestQuote' => $record->id]);
                    })
                    ->requiresConfirmation()
                    ->visible(function (RequestQuote $record): bool {
                        return ! $record->is_payed;
                    })
                    ->icon('heroicon-o-check'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRequestQuotes::route('/'),
            'view' => ViewRequestQuote::route('/{record}'),
        ];
    }

    public static function getWidgets(): array
    {
        return [
            RequestQuotePriceWidget::class,
        ];
    }
}
