<?php

declare(strict_types=1);

use App\Http\Controllers\FormController;
use App\Http\Controllers\FormSubmissionController;
use App\Http\Controllers\PaymentController;
use App\Livewire\Cart\CartShow;
use App\Livewire\CheckoutSuccess;
use App\Livewire\FormQuestionForm;
use App\Livewire\GuestShowQuaotationForm;
use App\Livewire\PaymentPage;
use App\Models\Order;
use App\Models\RequestQuote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

require_once __DIR__ . '/auth.php';

Route::get('/', function () {
    return redirect()->route('filament.admin.auth.login');
})->name('home');

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

Route::get('/cart/summary', CartShow::class)->name('cart.summary');
Route::get('/payment/{record}', PaymentPage::class)->name('payment.page');
/* Route::post('/payment/stripe', [PaymentController::class, 'stripePayment'])->name('stripe.payment');
Route::get('/order/finalize', [PaymentController::class, 'finalizeOrder'])->name('order.finalize'); */
Route::middleware(['auth'])->get('/checkout', function (Request $request) {
    $quantity = 1;
    $order = Order::factory()->create([
        'user_id' => $request->user()->id,
        'status' => 'pending',
        'stripe_order_id' => Str::uuid()->toString(),
        'amount' => $quantity,
    ]);

    $stripePriceId = 'prod_SDH5goUSju2dYP';

    return $request->user()->checkoutCharge(50000 * 100, 'Website Laravel', 1, [
        'success_url' => route('checkout-success'),
        'cancel_url' => route('checkout-cancel'),
        'metadata' => [
            'order_id' => $order->id,
        ],
    ]);
})->name('checkout');

Route::get('/checkout/summary/{requestQuote}', PaymentPage::class)->name('checkout.summary');

Route::get('/checkout/success', CheckoutSuccess::class)->name('checkout-success');
Route::view('/checkout/cancel', 'livewire.cancel')->name('checkout-cancel');

Route::view('/elkuldve', 'livewire.email-sended')->name('email-sended-to-user');
