<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use Filament\Schemas\Schema;
use Filament\Actions\ViewAction;
use Filament\Actions\EditAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages\CreateRequestQuoteFunctionality;
use App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages\EditRequestQuoteFunctionality;
use App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages\ListRequestQuoteFunctionalities;
use App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages\ViewRequestQuoteFunctionality;
use App\Models\RequestQuoteFunctionality;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class RequestQuoteFunctionalityResource extends Resource
{
    protected static ?string $model = RequestQuoteFunctionality::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string | \UnitEnum | null $navigationGroup = 'Request Quote';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('price')
                    ->numeric()
                    ->default(0)
                    ->postfix('Ft'),
                RichEditor::make('description')
                    ->maxLength(65535)
                    ->placeholder('Description'),
                Select::make('website_type_id')
                    ->relationship('websiteType', 'name')
                    ->required()
                    ->preload()
                    ->placeholder('Select a website type'),
                Checkbox::make('default')
                    ->label('Default')
                    ->helperText('This functionality will be selected by default for all new request quotes.')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('price')
                    ->money('HUF', 0, 'hu_HU')
                    ->sortable(),
                TextColumn::make('websiteType.name')
                    ->label('Website Type')
                    ->sortable()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: false),
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
            'index' => ListRequestQuoteFunctionalities::route('/'),
            'create' => CreateRequestQuoteFunctionality::route('/create'),
            'view' => ViewRequestQuoteFunctionality::route('/{record}'),
            'edit' => EditRequestQuoteFunctionality::route('/{record}/edit'),
        ];
    }
}
