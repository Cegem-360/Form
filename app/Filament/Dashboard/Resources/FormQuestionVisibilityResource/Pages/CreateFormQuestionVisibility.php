<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\FormQuestionVisibilityResource\Pages;

use App\Filament\Resources\Dashboard\FormQuestionVisibilityResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateFormQuestionVisibility extends CreateRecord
{
    protected static string $resource = FormQuestionVisibilityResource::class;
}
