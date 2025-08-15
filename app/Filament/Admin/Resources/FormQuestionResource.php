<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FormQuestionResource\Pages\CreateFormQuestion;
use App\Filament\Admin\Resources\FormQuestionResource\Pages\EditFormQuestion;
use App\Filament\Admin\Resources\FormQuestionResource\Pages\ListFormQuestions;
use App\Filament\Admin\Resources\FormQuestionResource\Pages\ViewFormQuestion;
use App\Filament\Admin\Resources\FormQuestionResource\Schemas\Form\FormQuestionForm;
use App\Models\FormQuestion;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class FormQuestionResource extends Resource
{
    protected static ?string $model = FormQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Project';

    protected static ?string $navigationLabel = 'Form kérdések';

    protected static ?string $modelLabel = 'form kérdés';

    protected static ?string $pluralModelLabel = 'form kérdések';

    protected static ?int $navigationSort = 1;

    public static function form(Schema $schema): Schema
    {
        return FormQuestionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->searchable()
                    ->sortable(),
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
            'index' => ListFormQuestions::route('/'),
            'create' => CreateFormQuestion::route('/create'),
            'edit' => EditFormQuestion::route('/{record}/edit'),
            'view' => ViewFormQuestion::route('/{record}'),
        ];
    }
}
