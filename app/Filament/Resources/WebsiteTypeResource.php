<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\WebsiteTypeResource\Pages;
use App\Filament\Resources\WebsiteTypeResource\RelationManagers\RequestQuoteFunctionalitiesRelationManager;
use App\Models\WebsiteType;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class WebsiteTypeResource extends Resource
{
    protected static ?string $model = WebsiteType::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Request Quote';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
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
            RequestQuoteFunctionalitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWebsiteTypes::route('/'),
            'create' => Pages\CreateWebsiteType::route('/create'),
            'view' => Pages\ViewWebsiteType::route('/{record}'),
            'edit' => Pages\EditWebsiteType::route('/{record}/edit'),
        ];
    }
}
