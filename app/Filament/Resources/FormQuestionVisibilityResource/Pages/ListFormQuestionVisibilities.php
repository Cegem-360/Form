<?php

declare(strict_types=1);

namespace App\Filament\Resources\FormQuestionVisibilityResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\FormQuestionVisibilityResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFormQuestionVisibilities extends ListRecords
{
    protected static string $resource = FormQuestionVisibilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
