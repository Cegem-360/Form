<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\WebsiteTypeResource\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class RequestQuoteFunctionalitiesRelationManager extends RelationManager
{
    protected static string $relationship = 'RequestQuoteFunctionalities';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
