<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Admin\Resources\WebsiteTypePriceResource\Pages\CreateWebsiteTypePrice;
use App\Filament\Admin\Resources\WebsiteTypePriceResource\Pages\EditWebsiteTypePrice;
use App\Filament\Admin\Resources\WebsiteTypePriceResource\Pages\ListWebsiteTypePrices;
use App\Models\WebsiteTypePrice;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class WebsiteTypePriceResource extends Resource
{
    protected static ?string $model = WebsiteTypePrice::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Request Quote';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('website_type_id')
                    ->relationship('websiteType', 'name')
                    ->required(),
                TextInput::make('website_engine')
                    ->required()
                    ->maxLength(255),
                Select::make('size')
                    ->required()
                    ->options([
                        'short' => 'Rövid',
                        'medium' => 'Közepes',
                        'long' => 'Hosszú',
                    ]),
                TextInput::make('price')
                    ->numeric()
                    ->default(0)
                    ->postfix('Ft'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('websiteType.name')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('website_engine')
                    ->searchable(),
                TextColumn::make('size')
                    ->searchable(),
                TextColumn::make('price')
                    ->money('HUF')

                    ->sortable(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWebsiteTypePrices::route('/'),
            'create' => CreateWebsiteTypePrice::route('/create'),
            'edit' => EditWebsiteTypePrice::route('/{record}/edit'),
        ];
    }
}
