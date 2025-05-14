<?php

declare(strict_types=1);

use App\Livewire\Cart\CartShow;
use App\Livewire\Checkout\CheckoutSuccess;
use App\Livewire\Checkout\CheckoutUnsuccess;
use App\Livewire\Checkout\PaymentPage;
use App\Livewire\FormQuestionForm;
use App\Livewire\GuestShowQuaotationForm;
use App\Models\RequestQuote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;

require_once __DIR__.'/auth.php';

Route::middleware(['auth'])->get('/', function () {
    return redirect()->route('filament.admin.pages.dashboard');
})->name('home');

Route::get('/kerdoiv/{token?}', FormQuestionForm::class)->name('kerdoiv');

Route::get('/form/expired', function () {
    return view('form.expired');
})->name('form.expired');

Route::get('arajanlat', GuestShowQuaotationForm::class)->name('quotation');

Route::get('pdf/{requestQuote}', function (RequestQuote $requestQuote) {
    return view('pdf.quotation-user', ['requestQuote' => $requestQuote]);
})->name('quotation.pdf');

Route::name('quotation.')->prefix('quotation')->group(function (): void {
    Route::get('preview/{requestQuote}', function () {

        $requestQuote = RequestQuote::factory()->make([
            'id' => 1,
            'company_name' => 'Test Company',
            'name' => 'Test Name',
            'email' => '',
        ]);
        $template = view('pdf.quotation-user', ['requestQuote' => $requestQuote])->render();

        Browsershot::html($template)->savePdf(storage_path('app/public/quotation.pdf'));

        return response()->file(storage_path('app/public/quotation.pdf'));
        /* ->setOption('args', ['--no-sandbox'])
        ->setOption('disable-smart-shrinking', true)
        ->setOption('viewport', ['width' => 1280, 'height' => 800])
        ->setOption('format', 'A4')
        ->setOption('margin-top', '0')
        ->setOption('margin-bottom', '0')
        ->setOption('margin-left', '0')
        ->setOption('margin-right', '0')
        ->pdf() */

    })->name('preview');

    /* Route::get('preview/{requestQuote}', function (RequestQuote $requestQuote) {
        $pdf = Pdf::loadView('pdf.quotation-user', ['requestQuote' => $requestQuote]);

        return $pdf->stream('quotation-preview.pdf');
    })->name('preview.id'); */
});
Route::middleware(['auth'])->name('cart.')->prefix('cart')->group(function (): void {
    Route::get('summary/{requestQuote}', CartShow::class)->name('summary');
});

Route::name('checkout.')->prefix('checkout')->group(function (): void {

    Route::middleware(['auth'])->get('/summary/{requestQuote}', PaymentPage::class)->name('summary');
    Route::get('success/{requestQuote}', CheckoutSuccess::class)->name('success');
    Route::get('unsuccess/{requestQuote}', CheckoutUnsuccess::class)->name('unsuccess');

});

Route::view('/elkuldve', 'livewire.email-sended')->name('email-sended-to-user');
