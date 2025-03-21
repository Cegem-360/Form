<?php

declare(strict_types=1);

use App\Http\Controllers\FormController;
use App\Http\Controllers\FormSubmissionController;
use App\Livewire\FormQuestionForm;
use App\Models\FormQuestion;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Route::get('/questions/{token?}', FormQuestion::class)->name('questions');
Route::get('/kerdoiv/{token?}', FormQuestionForm::class)->name('kerdoiv');

Route::get('/form-review/{form}', [FormSubmissionController::class, 'review'])->name('form.review');

Route::get('/form/expired', [FormController::class, 'expired'])->name('form.expired');
