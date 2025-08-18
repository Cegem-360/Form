<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Enums\ProjectStatus;
use App\Filament\Dashboard\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Dashboard\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Dashboard\Resources\ProjectResource\Pages\ListProjects;
use App\Filament\Dashboard\Resources\ProjectResource\Pages\ViewProject;
use App\Models\Project;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

final class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function getNavigationGroup(): string
    {
        return __('Projects');
    }

    public static function getLabel(): string
    {
        return __('Projects');
    }

    public static function getPluralLabel(): string
    {
        return __('Projects');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema

            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('start_date'),
                DatePicker::make('end_date'),
                Select::make('status')
                    ->options(ProjectStatus::class)
                    ->required(),
                RichEditor::make('project_goal')
                    ->columnSpanFull(),

                TextInput::make('completed_project_elements'),
                TextInput::make('project_not_contained_elements'),

                TextInput::make('solved_problems'),
                TextInput::make('garanty')
                    ->numeric(),
                DatePicker::make('garanty_end_date'),
                Select::make('contact')
                    ->relationship('contact', 'name'),
                Select::make('support_pack_id')
                    ->label('Support Pack')
                    ->relationship('supportPack', 'name'),
                Select::make('contact_channel_id')
                    ->label('Contact Channel')
                    ->relationship('contactChannel', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function ($query) {
                return $query->whereUserId(Auth::user()->id);
            })
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
                TextColumn::make('support_pack_id.name')
                    ->label('Support Pack')
                    ->sortable(),
                TextColumn::make('contact_channel_id.name')
                    ->label('Contact Channel')
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
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
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
