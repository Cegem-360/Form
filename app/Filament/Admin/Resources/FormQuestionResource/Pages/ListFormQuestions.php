<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionResource\Pages;

use App\Filament\Admin\Resources\FormQuestionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListFormQuestions extends ListRecords
{
    protected static string $resource = FormQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
