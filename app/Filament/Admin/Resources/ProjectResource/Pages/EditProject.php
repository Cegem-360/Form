<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages;

use App\Enums\ProjectStatus;
use App\Filament\Admin\Resources\ProjectResource;
use App\Models\FormQuestion;
use App\Models\Project;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

final class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('EndTheProject')
                ->label(__('End The Project'))
                ->color('success')
                ->action(function (Project $record) {
                    $record->update(['status' => ProjectStatus::COMPLETED]);
                    Notification::make()
                        ->success()
                        ->title(__('The project has been ended successfully.'))
                        ->send();

                    return $this->redirect($this->getResource()::getUrl('edit', ['record' => $record->getKey()]));
                })
                ->visible(fn ($record) => $record->status !== ProjectStatus::COMPLETED),
            ViewAction::make(),
            DeleteAction::make(),
            ActionGroup::make([
                Action::make('convertToStarter')
                    ->label('Convert to Starter')
                    ->action(function (array $data, Project $record) {

                        $pages = collect($record->requestQuote->websites)->map(function (array $page): array {
                            return [
                                'name' => $page['name'],
                            ];
                        })->toArray();
                        $formQuestion = FormQuestion::query()->create([
                            'project_id' => $record->id,
                            'user_id' => $record->user_id,
                            'company_name' => $record->user->company_name,
                            'contact_email' => $record->requestQuote->email,
                            'contact_name' => $record->requestQuote->name,
                            'contact_phone' => $record->requestQuote->phone,
                            'main_pages' => $pages,
                        ]);

                        return redirect()->route('filament.admin.resources.form-questions.edit', ['record' => $formQuestion->id]);

                    })
                    ->color('primary'),

            ]),
        ];
    }
}
