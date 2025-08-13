<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Admin\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Admin\Resources\ProjectResource\Pages\ListProjects;
use App\Filament\Admin\Resources\ProjectResource\Pages\ViewProject;
use App\Filament\Admin\Resources\ProjectResource\Schemas\ProjectForm;
use App\Filament\Admin\Resources\ProjectResource\Schemas\ProjectTable;
use App\Models\Project;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

final class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Project';

    protected static ?int $navigationSort = 0;

    public static function form(Schema $schema): Schema
    {
        return ProjectForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProjectTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'view' => ViewProject::route('/{record}'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
