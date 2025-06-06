<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionResource\Pages;

use App\Filament\Admin\Resources\FormQuestionResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateFormQuestion extends CreateRecord
{
    protected static string $resource = FormQuestionResource::class;
}
