<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages\Actions;

use App\Models\Project;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

final class GenerateExampleDocument
{
    public static function make(EditRecord $component): Action
    {
        return Action::make('generate_maintenance_contract')
            ->label('Üzemeltetési megbízási szerződés')
            ->icon('heroicon-o-document-text')
            ->color('info')
            ->url(function () use ($component): string {
                /** @var Project $project */
                $project = $component->getRecord();

                return route('project.pdf.maintenance-contract', ['project' => $project->id]);
            })
            ->openUrlInNewTab();
    }
}
