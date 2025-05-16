<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PdfOptionResource\Pages\CreatePdfOption;
use App\Filament\Admin\Resources\PdfOptionResource\Pages\EditPdfOption;
use App\Filament\Admin\Resources\PdfOptionResource\Pages\ListPdfOptions;
use App\Models\PdfOption;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class PdfOptionResource extends Resource
{
    protected static ?string $model = PdfOption::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('website_type_id')
                    ->relationship('websiteType', 'name')
                    ->required(),
                Select::make('website_engine')
                    ->options([
                        'wordpress' => 'WordPress',
                        'shopify' => 'Shopify',
                        'laravel' => 'Laravel',
                    ]),
                RichEditor::make('frontend_description')
                    ->columnSpanFull(),
                RichEditor::make('backend_description')
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
            ->actions([
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
            'index' => ListPdfOptions::route('/'),
            'create' => CreatePdfOption::route('/create'),
            'edit' => EditPdfOption::route('/{record}/edit'),
        ];
    }
}
