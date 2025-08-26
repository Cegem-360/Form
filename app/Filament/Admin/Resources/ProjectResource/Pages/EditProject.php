<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages;

use App\Filament\Admin\Resources\ProjectResource;
use App\Filament\Admin\Resources\ProjectResource\Pages\Actions\ConvertToStarter;
use App\Filament\Admin\Resources\ProjectResource\Pages\Actions\EndTheProject;
use App\Filament\Admin\Resources\ProjectResource\Pages\Actions\GenerateCompletionDocument;
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
            EndTheProject::make(component: $this),
            ViewAction::make(),
            DeleteAction::make(),
            GenerateCompletionDocument::make(component: $this),
            ActionGroup::make([
                ConvertToStarter::make(component: $this),
                // üzemeltetési megbízási szerződés
                // szerződés csak akkor ha aláírják
                // support pack kell egy mező  hány havonta  menjen ki és kell end_date
                // passive status ->nincs action
                // support pack status??
                // 3. gomb feltöltés
            ]),
        ];
    }
}
