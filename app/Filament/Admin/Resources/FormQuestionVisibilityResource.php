<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\FormQuestionVisibilityResource\Pages\CreateFormQuestionVisibility;
use App\Filament\Admin\Resources\FormQuestionVisibilityResource\Pages\EditFormQuestionVisibility;
use App\Filament\Admin\Resources\FormQuestionVisibilityResource\Pages\ListFormQuestionVisibilities;
use App\Filament\Admin\Resources\ProjectResource\Schemas\QuestionVisibilityForm;
use App\Filament\Admin\Resources\ProjectResource\Schemas\QuestionVisibilityTable;
use App\Models\FormQuestionVisibility;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

final class FormQuestionVisibilityResource extends Resource
{
    protected static ?string $model = FormQuestionVisibility::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return QuestionVisibilityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return QuestionVisibilityTable::configure($table);
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
            'index' => ListFormQuestionVisibilities::route('/'),
            'create' => CreateFormQuestionVisibility::route('/create'),
            'edit' => EditFormQuestionVisibility::route('/{record}/edit'),
        ];
    }
}
