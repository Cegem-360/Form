<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\ProjectResource\Pages\Actions;

use App\Models\Project;
use App\Services\ProjectCompletionDocumentService;
use Exception;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\ViewRecord;

final class GenerateCompletionDocument
{
    public static function make(EditRecord|ViewRecord $component): ActionGroup
    {
        return ActionGroup::make([

            self::pdfAction($component),
            self::googleDocsAction($component),
            self::saveToStorageAction($component),
        ])
            ->label('Teljesítési Igazolás')
            ->icon('heroicon-o-document-text')
            ->button()
            ->color('success');
    }

    private static function pdfAction(EditRecord|ViewRecord $component): Action
    {
        return Action::make('generateCompletionPdf')
            ->label('PDF Letöltése')
            ->icon('heroicon-o-document-arrow-down')
            ->url(function () use ($component) {
                /** @var Project $project */
                $project = $component->getRecord();

                if (! $project->end_date) {
                    return null; // No URL if project is not finished
                }

                return route('project.pdf.completion', ['project' => $project->id]);
            }, true)
            ->disabled(fn () => ! $component->getRecord()->end_date)
            ->tooltip(fn () => ! $component->getRecord()->end_date ? 'A projekt befejezési dátuma nincs beállítva!' : null);
    }

    private static function googleDocsAction(EditRecord|ViewRecord $component): Action
    {
        return Action::make('exportToGoogleDocs')
            ->label('Google Docs Export')
            ->icon('heroicon-o-cloud-arrow-up')
            ->action(function () use ($component) {
                /** @var Project $project */
                $project = $component->getRecord();
                
                try {
                    $service = new ProjectCompletionDocumentService($project);
                    $googleDocUrl = $service->exportForGoogleDocs();
                    
                    Notification::make()
                        ->title('Sikeresen feltöltve!')
                        ->body('A projekt teljesítési igazolás sikeresen létrejött a Google Drive-on.')
                        ->success()
                        ->actions([
                            Action::make('view')
                                ->label('Megnyitás')
                                ->url($googleDocUrl, shouldOpenInNewTab: true),
                        ])
                        ->send();
                        
                } catch (Exception $e) {
                    Notification::make()
                        ->title('Hiba történt!')
                        ->body('Nem sikerült feltölteni a Google Drive-ra: ' . $e->getMessage())
                        ->danger()
                        ->send();
                }
            })
            ->disabled(fn () => ! $component->getRecord()->end_date)
            ->tooltip(fn () => ! $component->getRecord()->end_date ? 'A projekt befejezesi datuma nincs beallitva!' : null);
    }

    private static function saveToStorageAction(EditRecord|ViewRecord $component): Action
    {
        return Action::make('saveCompletionToStorage')
            ->label('Mentés és Megtekintés')
            ->icon('heroicon-o-archive-box-arrow-down')
            ->url(function () use ($component) {
                /** @var Project $project */
                $project = $component->getRecord();

                if (! $project->end_date) {
                    return null; // No URL if project is not finished
                }

                return route('project.pdf.storage', ['project' => $project->id]);
            }, true)
            ->disabled(fn () => ! $component->getRecord()->end_date)
            ->tooltip(fn () => ! $component->getRecord()->end_date ? 'A projekt befejezési dátuma nincs beállítva!' : null);
    }
}
