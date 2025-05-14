<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Filament\Resources\WebsiteTypeResource\Pages\CreateWebsiteType;
use App\Filament\Resources\WebsiteTypeResource\Pages\EditWebsiteType;
use App\Filament\Resources\WebsiteTypeResource\Pages\ListWebsiteTypes;
use App\Filament\Resources\WebsiteTypeResource\Pages\ViewWebsiteType;
use App\Filament\Resources\WebsiteTypeResource\RelationManagers\RequestQuoteFunctionalitiesRelationManager;
use App\Models\WebsiteType;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class WebsiteTypeResource extends Resource
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
                TextColumn::make('name')
                    ->searchable(),
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
            RequestQuoteFunctionalitiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWebsiteTypes::route('/'),
            'create' => CreateWebsiteType::route('/create'),
            'view' => ViewWebsiteType::route('/{record}'),
            'edit' => EditWebsiteType::route('/{record}/edit'),
        ];
    }
}
