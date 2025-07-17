<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Enums\ProjectStatus;
use App\Filament\Admin\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Admin\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Admin\Resources\ProjectResource\Pages\ListProjects;
use App\Filament\Admin\Resources\ProjectResource\Pages\ViewProject;
use App\Models\Project;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use UnitEnum;

final class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Project';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name'),
                Select::make('request_quote_id')
                    ->relationship('requestQuote', 'quotation_name'),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                Select::make('status')

                    ->label('Project Status')
                    ->options(ProjectStatus::class)
                    ->enum(ProjectStatus::class)
                    ->required(),
                RichEditor::make('project_goal')
                    ->columnSpanFull(),
                TextInput::make('original_project_goals'),
                TextInput::make('completed_project_elements'),
                TextInput::make('project_not_contained_elements'),
                TextInput::make('completed_elements'),
                TextInput::make('solved_problems'),
                TextInput::make('garanty')
                    ->numeric(),
                DatePicker::make('garanty_end_date'),
                Select::make('contact')
                    ->relationship('contact', 'name'),
                Select::make('support_pack_id')
                    ->relationship('supportPack', 'name'),
                Select::make('contact_channel_id')
                    ->relationship('contactChannel', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('status'),
                TextColumn::make('garanty')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('garanty_end_date')
                    ->date()
                    ->sortable(),
                TextColumn::make('contact')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('support_pack_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('contact_channel_id')
                    ->numeric()
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
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'view' => ViewProject::route('/{record}'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
