<?php

declare(strict_types=1);

use App\Http\Controllers\FormController;
use App\Http\Controllers\FormSubmissionController;
use App\Livewire\FormQuestionForm;
use App\Livewire\GuestShowQuaotationForm;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('filament.admin.auth.login');
});

Route::get('/kerdoiv/{token?}', FormQuestionForm::class)->name('kerdoiv');

Route::get('/form-review/{form}', [FormSubmissionController::class, 'review'])->name('form.review');

Route::get('/form/expired', [FormController::class, 'expired'])->name('form.expired');

Route::get('quotation', GuestShowQuaotationForm::class)->name('quotation');
