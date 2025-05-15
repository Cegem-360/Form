<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionVisibilityResource\Pages;

use App\Filament\Resources\Admin\FormQuestionVisibilityResource;
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
