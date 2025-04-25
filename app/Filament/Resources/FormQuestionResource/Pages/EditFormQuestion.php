<?php

declare(strict_types=1);

namespace App\Filament\Resources\FormQuestionResource\Pages;

use App\Filament\Resources\FormQuestionResource;
use App\Jobs\UpdateAllWebsiteDataByDomain;
use App\Models\FormQuestion;
use App\Models\SystemChatParameter;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;

class EditFormQuestion extends EditRecord
{
    protected static string $resource = FormQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('Generate and View pdf')
                ->action(function (FormQuestion $formQuestion) {
                    $pdf = App::make('dompdf.wrapper');

                    $pdfContent = $pdf->loadView('pdf.form-question', ['formQuestion' => $formQuestion])->output();

                    // Save the PDF to a temporary location
                    $filePath = 'pdfs/' . uniqid() . '.pdf';
                    Storage::disk('public')->put($filePath, $pdfContent);

                    // Return the URL to the frontend
                    return redirect(Storage::url($filePath));
                }),
            Action::make('Send selected data to (ai) process')
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
                ->requiresConfirmation(),

        ];
    }
}
