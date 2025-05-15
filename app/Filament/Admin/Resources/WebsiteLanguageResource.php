<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\WebsiteLanguageResource\Pages\CreateWebsiteLanguage;
use App\Filament\Admin\Resources\WebsiteLanguageResource\Pages\EditWebsiteLanguage;
use App\Filament\Admin\Resources\WebsiteLanguageResource\Pages\ListWebsiteLanguages;
use App\Filament\Admin\Resources\WebsiteLanguageResource\Pages\ViewWebsiteLanguage;
use App\Models\WebsiteLanguage;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class WebsiteLanguageResource extends Resource
{
    protected static ?string $model = WebsiteLanguage::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            'index' => ListWebsiteLanguages::route('/'),
            'create' => CreateWebsiteLanguage::route('/create'),
            'view' => ViewWebsiteLanguage::route('/{record}'),
            'edit' => EditWebsiteLanguage::route('/{record}/edit'),
        ];
    }
}
