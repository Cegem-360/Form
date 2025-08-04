<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Enums\OpenAIRole;
use App\Filament\Admin\Resources\SystemChatParameterResource\Pages\CreateSystemChatParameter;
use App\Filament\Admin\Resources\SystemChatParameterResource\Pages\EditSystemChatParameter;
use App\Filament\Admin\Resources\SystemChatParameterResource\Pages\ListSystemChatParameters;
use App\Models\SystemChatParameter;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

final class SystemChatParameterResource extends Resource
{
    protected static ?string $model = SystemChatParameter::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static string|UnitEnum|null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
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
            ->recordActions([
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
            'index' => ListSystemChatParameters::route('/'),
            'create' => CreateSystemChatParameter::route('/create'),
            'edit' => EditSystemChatParameter::route('/{record}/edit'),
        ];
    }
}
