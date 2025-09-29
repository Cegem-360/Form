<?php

declare(strict_types=1);

namespace App\Filament\Admin\Pages;

use BackedEnum;
use Filament\Actions\Action;
use Filament\Forms\Components\CodeEditor;
use Filament\Forms\Components\CodeEditor\Enums\Language;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Schemas\Components\Tabs;
use Filament\Schemas\Components\Tabs\Tab;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\File;
use JsonException;
use UnitEnum;

final class LanguageEditor extends Page implements HasSchemas
{
    use InteractsWithSchemas;

    public ?array $data = [];

    protected static string|UnitEnum|null $navigationGroup = 'Beállítások';

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-language';

    protected static ?string $navigationLabel = 'Language Editor';

    protected static ?string $title = 'Language Files Editor';

    protected string $view = 'filament.admin.pages.language-editor';

    public function mount(): void
    {
        $this->form->fill([
            'hu_content' => $this->loadLanguageFile('hu'),
            'en_content' => $this->loadLanguageFile('en'),
            'de_content' => $this->loadLanguageFile('de'),
        ]);
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Tabs::make('Language Files')
                    ->tabs([
                        Tab::make('Hungarian (hu.json)')
                            ->schema([
                                CodeEditor::make('hu_content')
                                    ->label('Hungarian Translations')
                                    ->json()
                                    ->required()
                                    ->language(Language::Json)
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('English (en.json)')
                            ->schema([
                                CodeEditor::make('en_content')
                                    ->label('English Translations')
                                    ->language(Language::Json)
                                    ->json()
                                    ->required()
                                    ->columnSpanFull(),
                            ]),

                        Tab::make('German (de.json)')
                            ->schema([
                                CodeEditor::make('de_content')
                                    ->label('German Translations')
                                    ->language(Language::Json)
                                    ->json()
                                    ->required()
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columnSpanFull(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $results = [
            'hu' => $this->saveLanguageFile('hu', $data['hu_content']),
            'en' => $this->saveLanguageFile('en', $data['en_content']),
            'de' => $this->saveLanguageFile('de', $data['de_content']),
        ];

        $successful = array_filter($results);
        $failed = array_diff_key($results, $successful);

        if (count($successful) === 3) {
            Notification::make()
                ->title('All language files saved successfully!')
                ->success()
                ->send();
        } elseif (count($successful) > 0) {
            Notification::make()
                ->title('Some language files saved successfully')
                ->body('Saved: '.implode(', ', array_keys($successful)).'. Failed: '.implode(', ', array_keys($failed)))
                ->warning()
                ->send();
        } else {
            Notification::make()
                ->title('Failed to save language files')
                ->danger()
                ->send();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save All Languages')
                ->action('save')
                ->color('primary'),
        ];
    }

    private function loadLanguageFile(string $locale): string
    {
        $path = lang_path("{$locale}.json");

        if (! File::exists($path)) {
            return '{}';
        }

        $content = File::get($path);
        $decoded = json_decode($content, true);

        return json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    private function saveLanguageFile(string $locale, string $content): bool
    {
        try {
            $decoded = json_decode($content, true, 512, JSON_THROW_ON_ERROR);
            $formatted = json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            $path = lang_path("{$locale}.json");

            return File::put($path, $formatted) !== false;
        } catch (JsonException $e) {
            return false;
        }
    }
}
