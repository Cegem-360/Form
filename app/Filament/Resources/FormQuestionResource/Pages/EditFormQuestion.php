<?php

declare(strict_types=1);

namespace App\Filament\Resources\FormQuestionResource\Pages;

use App\Filament\Resources\FormQuestionResource;
use App\Models\FormQuestion;
use App\Models\SystemChatParameter;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\App;

class EditFormQuestion extends EditRecord
{
    protected static string $resource = FormQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('Generate and View pdf')
                ->action(function (FormQuestion $formQuestion) {
                    //
                    $pdf = App::make('dompdf.wrapper');

                    // return $pdf->loadView('pdf.form-question', ['formQuestion' => $formQuestion])->stream();

                    return response()->streamDownload(function () use ($pdf, $formQuestion) {
                        echo $pdf->loadView('pdf.form-question', ['formQuestion' => $formQuestion])->stream();
                    }, 'name.pdf');
                }),
            Action::make('Send selected data to (ai) process')
                ->form([
                    Select::make('fields')
                        ->options(SystemChatParameter::all()->pluck('form_field_name', 'form_field_id'))
                        ->multiple(),
                ])
                ->action(function (array $data): void {
                    // dispatc job with data
                    dump($data);
                })
                ->slideOver(),
            Action::make('Send all data to (ai) process')
                ->action(function (FormQuestion $form) {})
                ->requiresConfirmation(),

        ];
    }
}
