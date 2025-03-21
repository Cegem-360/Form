<?php

declare(strict_types=1);

namespace App\Filament\Resources;

use App\Enums\OpenAIRole;
use App\Filament\Resources\SystemChatParameterResource\Pages;
use App\Models\SystemChatParameter;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SystemChatParameterResource extends Resource
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
            'index' => Pages\ListSystemChatParameters::route('/'),
            'create' => Pages\CreateSystemChatParameter::route('/create'),
            'edit' => Pages\EditSystemChatParameter::route('/{record}/edit'),
        ];
    }
}
