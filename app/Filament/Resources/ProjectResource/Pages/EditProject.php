<?php

declare(strict_types=1);

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Models\FormQuestion;
use App\Models\Project;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Resources\Pages\EditRecord;

class EditProject extends EditRecord
{
    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
            ActionGroup::make([
                Action::make('convertToStarter')
                    ->label('Convert to Starter')
                    ->form([
                        // formquestion
                    ])
                    ->action(function (array $data, Project $record) {

                        $formQuestion = FormQuestion::create([
                            'project_id' => $record->id,
                            'user_id' => $record->user_id,
                            'company_name' => $record->requ,
                        ]);

                        return redirect()->route('filament.admin.resources.form-questions.edit', ['record' => $formQuestion->id]);

                    })
                    ->color('primary'),
            ]),
        ];
    }
}
