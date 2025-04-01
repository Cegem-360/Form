<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RequestQuoteResource\Pages;
use App\Models\RequestQuote;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
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
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('company_name')
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
                Repeater::make('websites')->schema([
                    TextInput::make('name')->required(),
                    ToggleButtons::make('Length')
                        ->options([
                            'short' => 'Short',
                            'medium' => 'Medium',
                            'long' => 'Long',
                        ])
                        ->inline()
                        ->required(),
                    // preview img for each length and description
                    FileUpload::make('preview_img')
                        ->label('Preview Image')
                        ->image()
                        ->disk('public')
                        ->directory('website_previews')
                        ->required(),
                    Forms\Components\TextInput::make('description')
                        ->required()
                        ->maxLength(255),
                ]),
                Forms\Components\Toggle::make('have_website_graphic')
                    ->required(),
                Forms\Components\TextInput::make('functionalities'),
                Forms\Components\Toggle::make('is_multilangual')
                    ->required(),
                Forms\Components\TextInput::make('languages'),
                Forms\Components\Toggle::make('is_ecommerce')
                    ->required(),
                Forms\Components\TextInput::make('ecommerce_functionalities'),
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
