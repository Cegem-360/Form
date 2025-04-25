<?php

declare(strict_types=1);

namespace App\Filament\Resources\FormQuestionVisibilityResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\FormQuestionVisibilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormQuestionVisibility extends EditRecord
{
    protected static string $resource = FormQuestionVisibilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
