<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages\CreateRequestQuoteFunctionality;
use App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages\EditRequestQuoteFunctionality;
use App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages\ListRequestQuoteFunctionalities;
use App\Filament\Admin\Resources\RequestQuoteFunctionalityResource\Pages\ViewRequestQuoteFunctionality;
use App\Models\RequestQuoteFunctionality;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class RequestQuoteFunctionalityResource extends Resource
{
    protected static ?string $model = RequestQuoteFunctionality::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Request Quote';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
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
            'index' => ListRequestQuoteFunctionalities::route('/'),
            'create' => CreateRequestQuoteFunctionality::route('/create'),
            'view' => ViewRequestQuoteFunctionality::route('/{record}'),
            'edit' => EditRequestQuoteFunctionality::route('/{record}/edit'),
        ];
    }
}
