<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionVisibilityResource\Pages;

use App\Filament\Resources\Admin\FormQuestionVisibilityResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateFormQuestionVisibility extends CreateRecord
{
    protected static string $resource = FormQuestionVisibilityResource::class;
}
