<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Enums\ProjectStatus;
use App\Filament\Dashboard\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Dashboard\Resources\ProjectResource\Pages\EditProject;
use App\Filament\Dashboard\Resources\ProjectResource\Pages\ListProjects;
use App\Filament\Dashboard\Resources\ProjectResource\Pages\ViewProject;
use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

final class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

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

    public static function form(Form $form): Form
    {
        return $form

            ->schema([
                TextInput::make('name')
                    ->translateLabel()
                    ->required()
                    ->maxLength(255),
                DatePicker::make('start_date')
                    ->translateLabel(),
                DatePicker::make('end_date')
                    ->translateLabel(),
                Select::make('status')
                    ->translateLabel()
                    ->options(ProjectStatus::class)
                    ->required(),
                RichEditor::make('project_goal')
                    ->translateLabel()
                    ->columnSpanFull(),
                TextInput::make('original_project_goals')
                    ->translateLabel(),
                TextInput::make('completed_project_elements')
                    ->translateLabel(),
                TextInput::make('project_not_contained_elements')
                    ->translateLabel(),
                TextInput::make('completed_elements')
                    ->translateLabel(),
                TextInput::make('solved_problems')
                    ->translateLabel(),
                TextInput::make('garanty')
                    ->translateLabel()
                    ->numeric(),
                DatePicker::make('garanty_end_date')
                    ->translateLabel(),
                Select::make('contact')
                    ->translateLabel()
                    ->relationship('contact', 'name'),
                Select::make('support_pack_id')
                    ->translateLabel()
                    ->label('Support Pack')
                    ->relationship('supportPack', 'name'),
                Select::make('contact_channel_id')
                    ->translateLabel()
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
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('start_date')
                    ->translateLabel()
                    ->date()
                    ->sortable(),
                TextColumn::make('end_date')
                    ->translateLabel()
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->translateLabel(),
                TextColumn::make('garanty')
                    ->translateLabel()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('garanty_end_date')
                    ->translateLabel()
                    ->date()
                    ->sortable(),
                TextColumn::make('contact')
                    ->translateLabel()
                    ->numeric()
                    ->sortable(),
                TextColumn::make('support_pack_id.name')
                    ->translateLabel()
                    ->label('Support Pack')
                    ->sortable(),
                TextColumn::make('contact_channel_id.name')
                    ->translateLabel()
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
            ->actions([
                ViewAction::make(),
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
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'view' => ViewProject::route('/{record}'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
