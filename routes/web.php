<?php

declare(strict_types=1);

use App\Http\Middleware\EnsureHasRequestQuote;
use App\Livewire\Cart\CartShow;
use App\Livewire\Checkout\CheckoutSuccess;
use App\Livewire\Checkout\CheckoutUnsuccess;
use App\Livewire\Checkout\PaymentPage;
use App\Livewire\FormQuestionForm;
use App\Livewire\GuestShowQuaotationForm;
use App\Models\RequestQuote;
use Illuminate\Support\Facades\Route;
use Spatie\Browsershot\Browsershot;

require_once __DIR__.'/auth.php';

Route::middleware(['auth'])->get('/', function () {
    return redirect()->route('filament.dashboard.pages.dashboard');
})->name('home');

Route::get('/form/expired', function () {
    return view('form.expired');
})->name('form.expired');

Route::get('arajanlat', GuestShowQuaotationForm::class)->name('quotation');

Route::get('pdf/{requestQuote}', function (RequestQuote $requestQuote) {
    return view('pdf.quotation-user', ['requestQuote' => $requestQuote]);
})->name('quotation.pdf');

Route::name('quotation.')->prefix('quotation')->group(function (): void {
    Route::get('preview/{requestQuote}', function (RequestQuote $requestQuote) {

        $requestQuote = RequestQuote::find($requestQuote->id);

        $template = view('pdf.quotation-user', ['requestQuote' => $requestQuote])->render();
        $headerHtml = view('pdf.header')->render();
        Browsershot::html($template)->showBrowserHeaderAndFooter()
            ->headerHtml($headerHtml)
            ->showBackground()
            ->format('A4')
            ->savePdf(storage_path('app/public/quotation.pdf'));

        return response()->file(storage_path('app/public/quotation.pdf'));

    })->name('preview');

    Route::get('preview/pdf/{requestQuote}', function () {

        $requestQuote = RequestQuote::factory()->make([
            'id' => 1,
            'company_name' => 'Test Company',
            'name' => 'Test Name',
            'email' => '',
        ]);

        return view('pdf.quotation-user', ['requestQuote' => $requestQuote]);

    })->name('preview.pdf');

});
Route::middleware(['auth'])->group(function (): void {

    Route::middleware([EnsureHasRequestQuote::class])->group(function (): void {
        Route::name('cart.')->prefix('cart')->group(function (): void {
            Route::get('summary/{requestQuote}', CartShow::class)->name('summary');
        });
        Route::name('checkout.')->prefix('checkout')->group(function (): void {

            Route::get('/summary/{requestQuote}', PaymentPage::class)->name('summary');
            Route::get('unsuccess/{requestQuote}', CheckoutUnsuccess::class)->name('unsuccess');

        });
    });

    Route::name('checkout.')->prefix('checkout')->group(function (): void {

        Route::get('success/{requestQuote}', CheckoutSuccess::class)->name('success');

    });

});
Route::get('kerdoiv/{token}', FormQuestionForm::class)->name('kerdoiv');

Route::view('/elkuldve', 'livewire.email-sended')->name('email-sended-to-user');
