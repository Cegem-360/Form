<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\RequestQuoteFunctionalityResource\Pages;
use App\Models\RequestQuoteFunctionality;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RequestQuoteFunctionalityResource extends Resource
{
    protected static ?string $model = RequestQuoteFunctionality::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Request Quote';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
                    ->numeric()
                    ->default(0)
                    ->prefix('$'),

                Select::make('website_type_id')
                    ->relationship('websiteType', 'name')
                    ->required()
                    ->preload()
                    ->searchable()
                    ->placeholder('Select a website type'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money()
                    ->sortable(),
                Tables\Columns\TextColumn::make('websiteType.name')
                    ->label('Website Type')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => Pages\ListRequestQuoteFunctionalities::route('/'),
            'create' => Pages\CreateRequestQuoteFunctionality::route('/create'),
            'view' => Pages\ViewRequestQuoteFunctionality::route('/{record}'),
            'edit' => Pages\EditRequestQuoteFunctionality::route('/{record}/edit'),
        ];
    }
}
