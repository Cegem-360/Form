<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages;

use App\Filament\Admin\Resources\ProjectResource;
use App\Models\FormQuestion;
use App\Models\Project;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

final class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            ActionGroup::make([
                /*  Action::make('convertToStarter')
                    ->label('Convert to Starter')
                    ->schema([

                    ])
                    ->action(function (array $data, Project $record) {

                        $pages = collect($record->requestQuote->websites)->map(function (array $page): array {
                            return [
                                'description' => $page['description'],
                                'name' => $page['name'],
                            ];
                        })->toArray();
                        $formQuestion = FormQuestion::create([
                            'project_id' => $record->id,
                            'user_id' => $record->user_id,
                            'company_name' => $record->requestQuote->company_name,
                            'main_pages' => $pages,
                        ]);

                        return redirect()->route('filament.admin.resources.form-questions.edit', ['record' => $formQuestion->id]);

                    })
                    ->color('primary'), */
            ]),
        ];
    }
}
