<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Enums\ClientType;
use App\Enums\RolesEnum;
use App\Filament\Dashboard\Resources\RequestQuoteResource\Pages\EditRequestQuote;
use App\Filament\Dashboard\Resources\RequestQuoteResource\Pages\ListRequestQuotes;
use App\Filament\Dashboard\Resources\RequestQuoteResource\Pages\ViewRequestQuote;
use App\Models\RequestQuote;
use App\Models\WebsiteLanguage;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Support\Enums\Alignment;
use Filament\Tables\Actions\Action as TableAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Session;

final class RequestQuoteResource extends Resource
{
    protected static ?string $model = RequestQuote::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    Select::make('user_id')
                        ->visible(Auth::user()->hasRole([RolesEnum::ADMIN, RolesEnum::SUPER_ADMIN]))
                        ->relationship('user', 'name')
                        ->preload()
                        ->searchable()
                        ->default(Auth::user()->id),
                    TextInput::make('quotation_name')
                        ->translateLabel()
                        ->maxLength(255),
                    TextInput::make('name')
                        ->translateLabel()
                        ->required()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->translateLabel()
                        ->required()
                        ->email()
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->translateLabel()
                        ->required()
                        ->tel()
                        ->maxLength(255),
                    RichEditor::make('project_description')
                        ->translateLabel()
                        ->maxLength(65535)
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                            'italic',
                            'strikeThrough',
                            'underline',
                        ])->columnSpanFull(),
                    TextInput::make('payment_method')
                        ->translateLabel()
                        ->disabled()
                        ->maxLength(255),
                    Select::make('client_type')
                        ->translateLabel()
                        ->required()
                        ->options(ClientType::class)
                        ->preload()
                        ->searchable(),
                    TextInput::make('company_name')
                        ->translateLabel()
                        ->maxLength(255),
                    TextInput::make('company_address')
                        ->translateLabel()
                        ->maxLength(255),
                    Select::make('website_type_id')
                        ->translateLabel()
                        ->live()
                        ->required()
                        ->relationship('websiteType', 'name')
                        ->afterStateUpdated(function (Set $set): void {
                            $set('request_quote_functionalities', []);
                        })
                        ->searchable(),
                    Select::make('website_engine')
                        ->translateLabel()
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
                        Grid::make(2)->columnSpan(1)->schema([
                            Grid::make(1)->columnSpan(1)->schema([
                                TextInput::make('name')
                                    ->translateLabel()
                                    ->required(),
                                ToggleButtons::make('required')
                                    ->translateLabel()
                                    ->live()
                                    ->options([
                                        '1' => __('Yes'),
                                        '0' => __('No'),
                                    ])
                                    ->inline()
                                    ->required(),
                                ToggleButtons::make('length')
                                    ->label('Content length')
                                    ->translateLabel()
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
                                RichEditor::make('description')
                                    ->translateLabel()
                                    ->required(fn ($get) => $get('required'))
                                    ->maxLength(65535)
                                    ->disableToolbarButtons([
                                        'attachFiles',
                                        'codeBlock',
                                        'italic',
                                        'strikeThrough',
                                        'underline',
                                    ]),
                                FileUpload::make('images')
                                    ->translateLabel()
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
                            Grid::make(1)->columnSpan(1)->schema([
                                ViewField::make('image')
                                    ->view('filament.forms.components.image')
                                    ->viewData(
                                        [
                                            'image' => fn (Get $get): mixed => $get('image'), // gets the image from the state
                                            'show_image' => true, // hides the image
                                        ]
                                    ),
                            ]),
                        ]),

                    ])
                        ->translateLabel(),

                ]),
                Grid::make(1)->schema([
                    Toggle::make('have_website_graphic')
                        ->default(false)
                        ->label('Do you have a website graphic?')
                        ->translateLabel()
                        ->disabled(),
                    Actions::make([
                        Action::make('yes')
                            ->hidden()
                            ->translateLabel()
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
                            ->translateLabel()
                            ->requiresConfirmation()
                            ->modalHeading(__('Website graphic'))
                            ->modalDescription(__("Are you sure you'd have website graphic form UI/UX designer?"))
                            ->modalSubmitActionLabel("No, I don't have a website graphic")
                            ->modalAlignment(Alignment::Center)
                            ->action(function (Set $set): void {
                                $set('have_website_graphic', false);
                            }),
                    ])->label('Do you have a website graphic?')->translateLabel(),
                ]),
                CheckboxList::make('request_quote_functionalities')
                    ->translateLabel()
                    ->relationship(name: 'requestQuoteFunctionalities', modifyQueryUsing: function (Get $get, Builder $query) {
                        return $query->where('website_type_id', $get('website_type_id'));
                    })
                    ->getOptionLabelFromRecordUsing(fn (Model $record): string => __($record->name)),
                Toggle::make('is_multilangual')
                    ->translateLabel()
                    ->live(),
                Select::make('default_language')
                    ->translateLabel()
                    ->live()
                    ->visible(fn ($get) => $get('is_multilangual'))
                    ->default(WebsiteLanguage::whereName('Hungarian')->firstOrCreate(['name' => 'Hungarian'])->id)
                    ->options(WebsiteLanguage::all()->pluck('name', 'id'))
                    ->afterStateUpdated(function (Set $set): void {
                        $set('languages', []);
                    })
                    ->searchable(),
                Select::make('languages')
                    ->translateLabel()
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
                if (Auth::user()->hasRole([RolesEnum::ADMIN, RolesEnum::SUPER_ADMIN])) {
                    return $query;
                }

                return $query->whereUserId($userId);
            })
            ->columns([
                TextColumn::make('quotation_name')
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('websiteType.name')
                    ->translateLabel()
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_multilangual')
                    ->translateLabel()
                    ->boolean(),
                TextColumn::make('created_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->translateLabel()
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                TableAction::make('order')
                    ->label(__('Order'))
                    ->action(function (Model $record) {
                        Session::put('requestQuote', $record->id);

                        return redirect()->route('cart.summary', ['requestQuote' => $record->id]);
                    })
                    ->requiresConfirmation()
                    ->visible(fn ($record): bool => $record->status !== 'order')
                    ->icon('heroicon-o-check'),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListRequestQuotes::route('/'),
            'view' => ViewRequestQuote::route('/{record}'),
            'edit' => EditRequestQuote::route('/{record}/edit'),
        ];
    }
}
