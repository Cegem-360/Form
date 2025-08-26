<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages\Actions;

use App\Filament\Admin\Resources\ProjectResource\Pages\EditProject;
use App\Models\FormQuestion;
use App\Models\Project;
use App\Models\WebsiteLanguage;
use Filament\Actions\Action;

final class ConvertToStarter
{
    public static function make(EditProject $component): Action
    {
        return Action::make('convertToStarter')
            ->label('Convert to Starter')
            ->action(function (Project $record) use ($component): void {

                $pages = collect($record->requestQuote->websites)->map(function (array $page): array {
                    return [
                        'name' => $page['name'],
                    ];
                })->toArray();

                $isMultilangual = (bool) ($record->requestQuote->is_multilangual ?? false);
                $defaultLanguage = $record->requestQuote->default_language ?? null;
                $languageIds = $record->requestQuote->languages ?? [];
                $languages = collect($languageIds)
                    ->map(fn (int|string $id) => WebsiteLanguage::query()->find(id: $id)?->name)
                    ->filter()
                    ->values();

                if ($defaultLanguage && $languages->contains($defaultLanguageName = WebsiteLanguage::query()->find($defaultLanguage)?->name)) {
                    $languages = $languages->reject(fn (string $name): bool => $name === $defaultLanguageName)->prepend($defaultLanguageName)->values();
                }

                $languages = $languages->all();

                $formQuestion = FormQuestion::query()->create([
                    'project_id' => $record->id,
                    'user_id' => $record->user_id,
                    'company_name' => $record->user->company_name,
                    'contact_email' => $record->requestQuote->email,
                    'contact_name' => $record->requestQuote->name,
                    'contact_phone' => $record->requestQuote->phone,
                    'need_multi_language' => $isMultilangual,
                    'languages_for_website' => $languages,
                    'main_pages' => $pages,
                ]);

                $component->redirect(route('filament.admin.resources.form-questions.edit', ['record' => $formQuestion->id]));

            })
            ->color('primary');
    }
}
