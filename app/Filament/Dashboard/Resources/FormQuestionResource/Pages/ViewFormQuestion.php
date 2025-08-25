<?php

declare(strict_types=1);

namespace App\Filament\Dashboard\Resources\FormQuestionResource\Pages;

use App\Filament\Dashboard\Resources\FormQuestionResource;
use Filament\Resources\Pages\ViewRecord;

final class ViewFormQuestion extends ViewRecord
{
    protected static string $resource = FormQuestionResource::class;

    protected string $view = 'filament.dashboard.resources.form-question-resource.pages.view-form-question';

    public function getTitle(): string
    {
        return __('View Form Question').' - '.$this->record->project->name;
    }

    protected function getHeaderActions(): array
    {
        return [];
    }
}
