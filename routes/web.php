<?php

declare(strict_types=1);

use App\Http\Controllers\FormController;
use App\Http\Controllers\FormSubmissionController;
use App\Livewire\FormQuestionForm;
use App\Livewire\GuestShowQuaotationForm;
use App\Models\RequestQuote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('filament.admin.auth.login');
});

Route::get('/kerdoiv/{token?}', FormQuestionForm::class)->name('kerdoiv');

Route::get('/form-review/{form}', [FormSubmissionController::class, 'review'])->name('form.review');

Route::get('/form/expired', [FormController::class, 'expired'])->name('form.expired');

Route::get('quotation', GuestShowQuaotationForm::class)->name('quotation');
Route::get('/quotation/preview', function () {

    $pdf = PDF::loadView('pdf.quotation-user', ['requestQuote' => RequestQuote::factory()->make([
        'id' => 1,
        'company_name' => 'Test Company',
        'name' => 'Test Name',
        'email' => 'test@test.com',
    ])]);

    return $pdf->stream('quotation-preview.pdf');
})->name('quotation.preview');

Route::get('/quotation/preview/{requestQuote}', function (RequestQuote $requestQuote) {
    $pdf = PDF::loadView('pdf.quotation-user', ['requestQuote' => $requestQuote]);

    return $pdf->stream('quotation-preview.pdf');
})->name('quotation.preview.id');
