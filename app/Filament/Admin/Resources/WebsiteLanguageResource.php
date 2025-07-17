<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WebsiteLanguageResource\Pages\CreateWebsiteLanguage;
use App\Filament\Admin\Resources\WebsiteLanguageResource\Pages\EditWebsiteLanguage;
use App\Filament\Admin\Resources\WebsiteLanguageResource\Pages\ListWebsiteLanguages;
use App\Filament\Admin\Resources\WebsiteLanguageResource\Pages\ViewWebsiteLanguage;
use App\Models\WebsiteLanguage;
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

final class WebsiteLanguageResource extends Resource
{
    protected static ?string $model = WebsiteLanguage::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    protected static ?string $navigationLabel = 'Website Languages';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->maxLength(255),
                TextInput::make('code')
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('code')
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListWebsiteLanguages::route('/'),
            'create' => CreateWebsiteLanguage::route('/create'),
            'view' => ViewWebsiteLanguage::route('/{record}'),
            'edit' => EditWebsiteLanguage::route('/{record}/edit'),
        ];
    }
}
