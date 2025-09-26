<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\LanguageFileResource\Pages\EditLanguageFile;
use App\Filament\Admin\Resources\LanguageFileResource\Pages\ListLanguageFiles;
use App\Models\LanguageFile;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LanguageFileResource extends Resource
{
    protected static ?string $model = LanguageFile::class;

    protected static ?string $navigationIcon = 'heroicon-o-language';

    protected static ?string $navigationLabel = 'Language Files';

    protected static ?string $modelLabel = 'Language File';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('locale')
                    ->label('Language')
                    ->disabled()
                    ->required(),

                CodeEditor::make('json_content')
                    ->label('JSON Content')
                    ->json()
                    ->required()
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('locale')
                    ->label('Language')
                    ->sortable(),

                TextColumn::make('path')
                    ->label('File Path')
                    ->limit(50),

                TextColumn::make('entries_count')
                    ->label('Entries Count')
                    ->sortable(),
            ])
            ->actions([
                EditAction::make(),
            ])
            ->paginated(false);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLanguageFiles::route('/'),
            'edit' => EditLanguageFile::route('/{record}/edit'),
        ];
    }
}