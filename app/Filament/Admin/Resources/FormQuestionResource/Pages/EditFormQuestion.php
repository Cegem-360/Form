<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\FormQuestionResource\Pages;

use App\Filament\Admin\Resources\FormQuestionResource;
use App\Jobs\UpdateAllWebsiteDataByDomain;
use App\Models\FormQuestion;
use App\Models\SystemChatParameter;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

final class EditFormQuestion extends EditRecord
{
    protected static string $resource = FormQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            Action::make('Generate and View pdf')
                ->action(function (FormQuestion $formQuestion) {
                    $pdf = Pdf::loadView('pdf.form-question', ['formQuestion' => $formQuestion], encoding: 'UTF-8');
                    $pdf->setPaper('A4', 'portrait');
                    $pdf->setOption('isHtml5ParserEnabled', true);
                    $pdf->setOption('isUnicodeEnabled', true);

                    $pdfContent = $pdf->output();

                    // Save the PDF to a temporary location
                    $filePath = 'pdfs/form-question-'.$formQuestion->id.'-'.time().'.pdf';
                    Storage::disk('public')->put($filePath, $pdfContent);

                    // Return the URL to the frontend
                    return redirect(Storage::url($filePath));
                }),
            /*  Action::make('Send selected data to (ai) process')
                ->form([
                    Select::make('fields')
                        ->options(SystemChatParameter::all()->pluck('form_field_name', 'form_field_id'))
                        ->multiple(),
                ])
                ->action(function (array $data, FormQuestion $formQuestion): void {
                    // dispatc job with data
                    UpdateAllWebsiteDataByDomain::dispatch($formQuestion->domain_id);
                    // $form = FormQuestion::find($data['fields']);
                })
                ->slideOver(),
            Action::make('Send all data to (ai) process')
                ->action(function (FormQuestion $form): void {})
                ->requiresConfirmation(), */

        ];
    }
}
