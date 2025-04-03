<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RequestQuoteResource\Pages;
use App\Models\RequestQuote;
use App\Models\WebsiteLanguage;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
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

class RequestQuoteResource extends Resource
{
    protected static ?string $model = RequestQuote::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Request Quote';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->email()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->tel()
                            ->maxLength(255),
                        TextInput::make('company_name')
                            ->maxLength(255),
                        Select::make('website_type_id')
                            ->required()
                            ->relationship('websiteType', 'name')
                            ->preload()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->searchable(),
                        Select::make('website_engine')
                            ->options([
                                'wordpress' => 'WordPress',
                                'Laravel' => 'Laravel',
                                'shopify' => 'Shopify',
                            ])->required()
                            ->searchable(),
                    ]),

                Grid::make(1)
                    ->schema([
                        Repeater::make('websites')->schema([
                            Grid::make(2)->columnSpan(1)
                                ->schema([
                                    Grid::make(1)->columnSpan(1)
                                        ->schema([
                                            TextInput::make('name')->required(),
                                            ToggleButtons::make('length')
                                                ->live()
                                                ->options([
                                                    'short' => 'Short',
                                                    'medium' => 'Medium',
                                                    'long' => 'Long',
                                                ])
                                                ->inline()
                                                ->afterStateUpdated(function ($state, Set $set, Get $get) {
                                                    $set('image', match ($state) {
                                                        'short' => 'website_previews/short_preview.png',
                                                        'medium' => 'medium_preview.jpg',
                                                        'long' => 'long_preview.jpg',
                                                        default => null,
                                                    });
                                                })
                                                ->required(),

                                        ]),
                                    Grid::make(1)->columnSpan(1)
                                        ->schema([
                                            ViewField::make('image')
                                                ->view('filament.forms.components.image')
                                                ->viewData(
                                                    [
                                                        function (Get $get) { // adds the initial state on page load
                                                            return $get('image');
                                                        },
                                                    ]
                                                )
                                                ->formatStateUsing(function (Get $get) {
                                                    return match ($get('length')) {
                                                        'short' => 'website_previews/short_preview.png',
                                                        'medium' => 'website_previews/medium_preview.jpg',
                                                        'long' => 'website_previews/long_preview.jpg',
                                                        default => null,
                                                    };
                                                }),
                                        ]),
                                ]),

                        ]),

                    ]),
                Grid::make(1)->schema(
                    [
                        Toggle::make('have_website_graphic')
                            ->default(false)
                            ->label('Do you have a website graphic?')
                            ->disabled(),
                        Actions::make([
                            Action::make('yes')
                                ->translateLabel()
                                ->requiresConfirmation()
                                ->modalHeading('Website graphic')
                                ->modalDescription('Are you sure you\'d have website graphic form UI/UX designer?')
                                ->modalSubmitActionLabel('Yes, I have a website graphic')
                                ->modalAlignment(Alignment::Center)
                                ->action(function (Set $set) {
                                    $set('have_website_graphic', true);
                                }),
                            Action::make('no')
                                ->translateLabel()
                                ->requiresConfirmation()
                                ->modalHeading('Website graphic')
                                ->modalDescription('Are you sure you\'d have website graphic form UI/UX designer?')
                                ->modalSubmitActionLabel('No, I don\'t have a website graphic')
                                ->modalAlignment(Alignment::Center)
                                ->action(function (Set $set) {
                                    $set('have_website_graphic', false);
                                }),
                        ])
                            ->label('Do you have a website graphic?'),

                    ]),
                Select::make('requestQuoteFunctionalities')->multiple()
                    ->relationship('requestQuoteFunctionalities', 'name')->preload(),

                Toggle::make('is_multilangual'),
                Select::make('languages')
                    ->options(WebsiteLanguage::all()->pluck('name', 'id'))
                    ->multiple()
                    ->preload()->searchable(),
                Toggle::make('is_ecommerce'),
                TextInput::make('ecommerce_functionalities'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('company_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('website_type_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\IconColumn::make('have_website_graphic')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_multilangual')
                    ->boolean(),
                Tables\Columns\IconColumn::make('is_ecommerce')
                    ->boolean(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListRequestQuotes::route('/'),
            'create' => Pages\CreateRequestQuote::route('/create'),
            'view' => Pages\ViewRequestQuote::route('/{record}'),
            'edit' => Pages\EditRequestQuote::route('/{record}/edit'),
        ];
    }
}
