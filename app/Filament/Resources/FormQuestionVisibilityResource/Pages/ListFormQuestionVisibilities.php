<?php

declare(strict_types=1);

namespace App\Filament\Resources\FormQuestionVisibilityResource\Pages;

use App\Filament\Resources\FormQuestionVisibilityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

final class ListFormQuestionVisibilities extends ListRecords
{
    protected static string $resource = FormQuestionVisibilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
