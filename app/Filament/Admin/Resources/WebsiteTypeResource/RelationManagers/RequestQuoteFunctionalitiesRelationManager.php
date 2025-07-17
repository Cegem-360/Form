<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\WebsiteTypeResource\RelationManagers;

use Filament\Schemas\Schema;
use Filament\Actions\CreateAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class RequestQuoteFunctionalitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'RequestQuoteFunctionalities';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('website_type_id')
                    ->required()
                    ->maxLength(255),
                TextInput::make('name'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('website_type_id')
            ->columns([
                TextColumn::make('website_type_id'),
                TextColumn::make('name')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
