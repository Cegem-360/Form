<?php

declare(strict_types=1);

namespace App\Filament\Resources\IdeaResource\Pages;

use Filament\Actions\ViewAction;
use Filament\Actions\DeleteAction;
use App\Filament\Resources\IdeaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIdea extends EditRecord
{
    protected static string $resource = IdeaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
