<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionVisibilityResource\Pages;

use App\Filament\Resources\Admin\FormQuestionVisibilityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

final class EditFormQuestionVisibility extends EditRecord
{
    protected static string $resource = FormQuestionVisibilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
