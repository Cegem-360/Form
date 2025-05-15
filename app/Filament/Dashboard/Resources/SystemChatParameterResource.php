<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources;

use App\Enums\OpenAIRole;
use App\Filament\Resources\Dashboard\SystemChatParameterResource\Pages\CreateSystemChatParameter;
use App\Filament\Resources\Dashboard\SystemChatParameterResource\Pages\EditSystemChatParameter;
use App\Filament\Resources\Dashboard\SystemChatParameterResource\Pages\ListSystemChatParameters;
use App\Models\SystemChatParameter;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

final class SystemChatParameterResource extends Resource
{
    protected static ?string $model = SystemChatParameter::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('form_field_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('form_field_id')
                    ->required()
                    ->numeric()
                    ->unique(ignoreRecord: true),
                Select::make('role')->enum(OpenAIRole::class)->options(OpenAIRole::class)
                    ->required(),
                RichEditor::make('content')
                    ->toolbarButtons([
                        'blockquote',
                        'bold',
                        'bulletList',
                        'codeBlock',
                        'h2',
                        'h3',
                        'italic',
                        'link',
                        'orderedList',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('form_field_name')
                    ->sortable()
                    ->searchable()
                    ->limit(50),
                TextColumn::make('role')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('role')->
                     options([
                         'System' => OpenAIRole::SYSTEM->value,
                         'User' => OpenAIRole::USER->value,
                     ]),
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
            'index' => ListSystemChatParameters::route('/'),
            'create' => CreateSystemChatParameter::route('/create'),
            'edit' => EditSystemChatParameter::route('/{record}/edit'),
        ];
    }
}
