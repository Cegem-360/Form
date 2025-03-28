<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Filament\Resources\ProjectResource\RelationManagers;
use App\Models\Project;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProjectResource extends Resource
{
    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date'),
                Forms\Components\DatePicker::make('end_date'),
                Forms\Components\TextInput::make('status')
                    ->required(),
                Forms\Components\Textarea::make('project_goal')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('original_project_goals'),
                Forms\Components\TextInput::make('completed_project_elements'),
                Forms\Components\TextInput::make('project_not_contained_elements'),
                Forms\Components\TextInput::make('completed_elements'),
                Forms\Components\TextInput::make('solved_problems'),
                Forms\Components\TextInput::make('garanty')
                    ->numeric(),
                Forms\Components\DatePicker::make('garanty_end_date'),
                Forms\Components\TextInput::make('contact')
                    ->numeric(),
                Forms\Components\TextInput::make('support_pack_id')
                    ->numeric(),
                Forms\Components\TextInput::make('contact_channel_id')
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status'),
                Tables\Columns\TextColumn::make('garanty')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('garanty_end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('support_pack_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact_channel_id')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }
}
