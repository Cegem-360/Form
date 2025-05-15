<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Filament\Dashboard\Resources\IdeaResource\Pages\CreateIdea;
use App\Filament\Dashboard\Resources\IdeaResource\Pages\EditIdea;
use App\Filament\Dashboard\Resources\IdeaResource\Pages\ListIdeas;
use App\Filament\Dashboard\Resources\IdeaResource\Pages\ViewIdea;
use App\Models\Idea;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

final class IdeaResource extends Resource
{
    protected static ?string $model = Idea::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Project';

    protected static ?string $navigationParentItem = 'Projects';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('project_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('project_id')
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
            'index' => ListIdeas::route('/'),
            'create' => CreateIdea::route('/create'),
            'view' => ViewIdea::route('/{record}'),
            'edit' => EditIdea::route('/{record}/edit'),
        ];
    }
}
