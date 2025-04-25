<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\RequestQuoteResource\Pages\ListRequestQuotes;
use App\Filament\Resources\RequestQuoteResource\Pages\CreateRequestQuote;
use App\Filament\Resources\RequestQuoteResource\Pages\ViewRequestQuote;
use App\Filament\Resources\RequestQuoteResource\Pages\EditRequestQuote;
use App\Enums\ClientType;
use App\Filament\Resources\RequestQuoteResource\Pages;
use App\Models\RequestQuote;
use App\Models\WebsiteLanguage;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\CheckboxList;
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
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class RequestQuoteResource extends Resource
{
    protected static ?string $model = RequestQuote::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Request Quote';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)->schema([
                    Select::make('user_id')
                        ->visible(Auth::user()->hasRole(['admin', 'super-admin']))
                        ->relationship('user', 'name')
                        ->preload()
                        ->searchable()
                        ->default(Auth::user()->id),
                    TextInput::make('quotation_name')
                        ->required()
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
                        ->required()
                        ->maxLength(65535)
                        ->disableToolbarButtons([
                            'attachFiles',
                            'codeBlock',
                            'italic',
                            'strikeThrough',
                            'underline',
                        ])->columnSpanFull(),
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
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                        ])
                        ->afterStateUpdated(function (Set $set): void {
                            $set('request_quote_functionalities', []);
                        })
                        ->searchable(),
                    Select::make('website_engine')
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
                                TextInput::make('name')->required(),
                                ToggleButtons::make('required')
                                    ->live()
                                    ->options([
                                        '1' => 'Yes',
                                        '0' => 'No',
                                    ])
                                    ->inline()
                                    ->required(),
                                ToggleButtons::make('length')
                                    ->live()
                                    ->options([
                                        'short' => 'Short',
                                        'medium' => 'Medium',
                                        'long' => 'Long',
                                    ])
                                    ->inline()
                                    ->afterStateUpdated(function ($state, Set $set, Get $get): void {
                                        $set('image', match ($state) {
                                            'short' => 'website_previews/short_preview.png',
                                            'medium' => 'website_previews/medium_preview.png',
                                            'long' => 'website_previews/long_preview.png',
                                            default => null,
                                        });
                                    })
                                    ->required(fn ($get) => $get('required')),
                                RichEditor::make('description')
                                    ->required(fn ($get) => $get('required'))
                                    ->maxLength(65535)
                                    ->disableToolbarButtons([
                                        'attachFiles',
                                        'codeBlock',
                                        'italic',
                                        'strikeThrough',
                                        'underline',
                                    ]),

                            ]),
                            Grid::make(1)->columnSpan(1)->schema([
                                ViewField::make('image')->view('filament.forms.components.image')->viewData(
                                    [
                                        'image' => fn (Get $get): mixed => $get('image'), // gets the image from the state
                                        'show_image' => false, // hides the image
                                    ]
                                )->formatStateUsing(function (Get $get): ?string {
                                    return match ($get('length')) {
                                        'short' => 'website_previews/short_preview.png',
                                        'medium' => 'website_previews/medium_preview.png',
                                        'long' => 'website_previews/long_preview.png',
                                        default => null,
                                    };
                                }),
                            ]),
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
                            ->translateLabel()
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
                    ->getOptionLabelFromRecordUsing(fn (Model $record): string => sprintf('%s %s', $record->name, $record->websiteType()->first()->name)),
                Toggle::make('is_multilangual'),
                Select::make('languages')
                    ->options(WebsiteLanguage::all()->pluck('name', 'id'))
                    ->multiple()
                    ->preload()
                    ->searchable(),

            ]);
    }

    public static function table(Table $table): Table
    {
        $user = Auth::user();
        $userId = $user->id;

        return $table
            ->modifyQueryUsing(function (Builder $query) use ($userId) {
                if (Auth::user()->hasRole(['admin', 'super-admin'])) {
                    return $query;
                }

                return $query->whereUserId($userId);
            })
            ->columns([
                TextColumn::make('quotation_name')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('company_name')
                    ->searchable(),
                TextColumn::make('website_type_id')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('have_website_graphic')
                    ->boolean(),
                IconColumn::make('is_multilangual')
                    ->boolean(),
                IconColumn::make('is_ecommerce')
                    ->boolean(),
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
            ->actions([
                ViewAction::make(),
                EditAction::make(),
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
            'create' => CreateRequestQuote::route('/create'),
            'view' => ViewRequestQuote::route('/{record}'),
            'edit' => EditRequestQuote::route('/{record}/edit'),
        ];
    }
}
