<?php

declare(strict_types=1);

use App\Http\Controllers\NotionController;
use App\Http\Middleware\EnsureHasRequestQuote;
use App\Livewire\Cart\CartShow;
use App\Livewire\Checkout\CheckoutSuccess;
use App\Livewire\Checkout\CheckoutUnsuccess;
use App\Livewire\Checkout\PaymentPage;
use App\Livewire\FormQuestionForm;
use App\Livewire\GuestShowQuaotationForm;
use App\Livewire\NotionUpload;
use App\Models\RequestQuote;
use FiveamCode\LaravelNotionApi\NotionFacade as Notion;
use Illuminate\Support\Facades\Route;

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
        return view('pdf.quotation-user', ['requestQuote' => $requestQuote]);

    })->name('preview');

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

Route::get('notion/api/', function () {

    return response()->json([
        'status' => 'success',
        'data' => Notion::pages()->find('239b80d668ac81c6bcd1ed79739679c8'),
    ]);
});

// Notion API endpoints
Route::prefix('notion')->name('notion.')->group(function (): void {
    Route::get('/test-upload', [NotionController::class, 'uploadTestData'])->name('test-upload');
    Route::get('/save-quote/{requestQuote}', [NotionController::class, 'saveRequestQuote'])->name('save-quote');
    Route::get('/query-database', [NotionController::class, 'queryDatabase'])->name('query-database');
    Route::post('/create-page', [NotionController::class, 'createCustomPage'])->name('create-page');
    Route::get('/page/{pageId}', [NotionController::class, 'getPage'])->name('get-page');
});

Route::get('kerdoiv/{token}', FormQuestionForm::class)->name('kerdoiv');

Route::get('notion-upload', NotionUpload::class)->name('notion-upload');

Route::view('/elkuldve', 'livewire.email-sended')->name('email-sended-to-user');
