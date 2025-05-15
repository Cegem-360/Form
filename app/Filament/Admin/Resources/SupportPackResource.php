<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Resources\Admin\SupportPackResource\Pages\CreateSupportPack;
use App\Filament\Resources\Admin\SupportPackResource\Pages\EditSupportPack;
use App\Filament\Resources\Admin\SupportPackResource\Pages\ListSupportPacks;
use App\Filament\Resources\Admin\SupportPackResource\Pages\ViewSupportPack;
use App\Models\SupportPack;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class SupportPackResource extends Resource
{
    protected static ?string $model = SupportPack::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Project';

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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSupportPacks::route('/'),
            'create' => CreateSupportPack::route('/create'),
            'view' => ViewSupportPack::route('/{record}'),
            'edit' => EditSupportPack::route('/{record}/edit'),
        ];
    }
}
