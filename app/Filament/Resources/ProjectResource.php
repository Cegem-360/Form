<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\ProjectResource\Pages\ListProjects;
use App\Filament\Resources\ProjectResource\Pages\CreateProject;
use App\Filament\Resources\ProjectResource\Pages\ViewProject;
use App\Filament\Resources\ProjectResource\Pages\EditProject;
use App\Enums\ProjectStatus;
use App\Enums\UserRole;
use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Project';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('user_id')
                    ->visible(Auth::user()->hasRole([UserRole::SUPER_ADMIN, UserRole::ADMIN]))
                    ->relationship('user', 'name'),
                Select::make('request_quote_id')
                    ->visible(Auth::user()->hasRole([UserRole::SUPER_ADMIN, UserRole::ADMIN]))
                    ->relationship('requestQuote', 'name'),
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
                TextInput::make('support_pack_id')
                    ->numeric(),
                TextInput::make('contact_channel_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
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
            'index' => ListProjects::route('/'),
            'create' => CreateProject::route('/create'),
            'view' => ViewProject::route('/{record}'),
            'edit' => EditProject::route('/{record}/edit'),
        ];
    }
}
