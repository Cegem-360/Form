<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\LanguageFileResource\Pages;

use App\Filament\Admin\Resources\LanguageFileResource;
use App\Models\LanguageFile;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditLanguageFile extends EditRecord
{
    protected static string $resource = LanguageFileResource::class;

    public function mount(int|string $record): void
    {
        $this->record = LanguageFile::find($record);

        if (!$this->record) {
            abort(404);
        }

        $this->fillForm();
    }

    protected function fillForm(): void
    {
        $this->form->fill([
            'locale' => $this->record->locale,
            'json_content' => $this->record->json_content,
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Save Changes')
                ->action('save')
                ->color('primary'),
        ];
    }

    public function save(): void
    {
        $data = $this->form->getState();

        try {
            $this->record->json_content = $data['json_content'];
            $saved = $this->record->save();

            if ($saved) {
                Notification::make()
                    ->title('Language file saved successfully')
                    ->success()
                    ->send();
            } else {
                Notification::make()
                    ->title('Failed to save language file')
                    ->danger()
                    ->send();
            }
        } catch (\Exception $e) {
            Notification::make()
                ->title('Error saving language file')
                ->body($e->getMessage())
                ->danger()
                ->send();
        }
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}