<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\FormQuestionResource\Pages;

use App\Filament\Dashboard\Resources\FormQuestionResource;
use Filament\Resources\Pages\ListRecords;

final class ListFormQuestions extends ListRecords
{
    protected static string $resource = FormQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [

        ];
    }
}
