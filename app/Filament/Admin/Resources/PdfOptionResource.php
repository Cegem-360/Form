<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Clusters\RequestQuoteOprions\RequestQuoteOprionsCluster;
use App\Filament\Admin\Resources\PdfOptionResource\Pages\CreatePdfOption;
use App\Filament\Admin\Resources\PdfOptionResource\Pages\EditPdfOption;
use App\Filament\Admin\Resources\PdfOptionResource\Pages\ListPdfOptions;
use App\Models\PdfOption;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class PdfOptionResource extends Resource
{
    protected static ?string $model = PdfOption::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Árajánlat';

    protected static ?string $cluster = RequestQuoteOprionsCluster::class;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('website_type_id')
                    ->relationship('websiteType', 'name')
                    ->required(),
                Select::make('website_engine')
                    ->options([
                        'laravel' => 'Laravel',
                    ]),
                RichEditor::make('frontend_description')
                    ->columnSpanFull(),
                RichEditor::make('backend_description')
                    ->columnSpanFull(),
                RichEditor::make('delivery_deadline')
                    ->label('Vállalási határidő')
                    ->columnSpanFull(),
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
            'index' => ListPdfOptions::route('/'),
            'create' => CreatePdfOption::route('/create'),
            'edit' => EditPdfOption::route('/{record}/edit'),
        ];
    }
}
