<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages\Actions;

use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;

final class GenerateMaintenanceQuote
{
    public static function make(EditRecord|ViewRecord $component): Action
    {
        return Action::make('generateMaintenanceQuote')
            ->label('Üzemeltetési Árajánlat')
            ->icon('heroicon-o-document-currency-dollar')
            ->url(function () use ($component): string {
                $project = $component->getRecord();

                return route('project.pdf.maintenance-quote', ['project' => $project->id]);
            }, true)
            ->button()
            ->color('info')
            ->tooltip('Üzemeltetési árajánlat PDF generálása');
    }
}
