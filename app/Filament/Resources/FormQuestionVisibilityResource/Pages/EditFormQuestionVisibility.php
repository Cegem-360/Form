<?php

namespace App\Filament\Resources\FormQuestionVisibilityResource\Pages;

use App\Filament\Resources\FormQuestionVisibilityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFormQuestionVisibility extends EditRecord
{
    protected static string $resource = FormQuestionVisibilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
