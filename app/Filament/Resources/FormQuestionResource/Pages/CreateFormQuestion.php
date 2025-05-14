<?php

declare(strict_types=1);

namespace App\Filament\Resources\FormQuestionResource\Pages;

use App\Filament\Resources\FormQuestionResource;
use Filament\Resources\Pages\CreateRecord;

final class CreateFormQuestion extends CreateRecord
{
    protected static string $resource = FormQuestionResource::class;
}
