<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WebsiteTypeResource\Pages\CreateWebsiteType;
use App\Filament\Admin\Resources\WebsiteTypeResource\Pages\EditWebsiteType;
use App\Filament\Admin\Resources\WebsiteTypeResource\Pages\ListWebsiteTypes;
use App\Filament\Admin\Resources\WebsiteTypeResource\Pages\ViewWebsiteType;
use App\Filament\Admin\Resources\WebsiteTypeResource\RelationManagers\RequestQuoteFunctionalitiesRelationManager;
use App\Models\WebsiteType;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class WebsiteTypeResource extends Resource
{
    protected static ?string $model = WebsiteType::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Request Quote';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
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
