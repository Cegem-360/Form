<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages\Actions;

use App\Enums\ProjectStatus;
use App\Filament\Admin\Resources\ProjectResource\Pages\EditProject;
use App\Models\Project;
use Filament\Actions\Action;
use Filament\Notifications\Notification;

final class EndTheProject
{
    public static function make(EditProject $component): Action
    {
        return Action::make('endTheProject')
            ->label(__('End The Project'))
            ->color('success')
            ->action(function (Project $record) use ($component) {
                $record->update(['status' => ProjectStatus::COMPLETED,
                    'end_date' => now(),
                ]);
                Notification::make()
                    ->success()
                    ->title(__('The project has been ended successfully.'))
                    ->send();

                return $component->redirect($component->getResource()::getUrl('edit', ['record' => $record->getKey()]));
            })
            ->visible(fn (Project $record): bool => $record->status !== ProjectStatus::COMPLETED && $record->garanty !== null);
    }
}
