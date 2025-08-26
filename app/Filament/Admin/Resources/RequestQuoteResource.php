<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RequestQuoteResource\Pages\CreateRequestQuote;
use App\Filament\Admin\Resources\RequestQuoteResource\Pages\EditRequestQuote;
use App\Filament\Admin\Resources\RequestQuoteResource\Pages\ListRequestQuotes;
use App\Filament\Admin\Resources\RequestQuoteResource\Pages\ViewRequestQuote;
use App\Filament\Admin\Resources\RequestQuoteResource\Schemas\RequestQuoteForm;
use App\Models\RequestQuote;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ReplicateAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use UnitEnum;

final class RequestQuoteResource extends Resource
{
    protected static ?string $model = RequestQuote::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Árajánlat';

    protected static ?string $navigationLabel = 'Árajánlatok';

    protected static ?string $modelLabel = 'Árajánlat';

    protected static ?int $navigationSort = 0;

    protected static ?string $pluralModelLabel = 'Árajánlatok';

    public static function form(Schema $schema): Schema
    {
        return RequestQuoteForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('quotation_name')
                    ->searchable(),
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('company_name')
                    ->searchable(),
                TextColumn::make('websiteType.name')
                    ->label('Website Type')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('is_multilangual')
                    ->boolean(),
                ToggleColumn::make('is_payed')
                    ->label('Is Payed'),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                ReplicateAction::make(),
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
            'index' => ListRequestQuotes::route('/'),
            'create' => CreateRequestQuote::route('/create'),
            'view' => ViewRequestQuote::route('/{record}'),
            'edit' => EditRequestQuote::route('/{record}/edit'),
        ];
    }
}
