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
use App\Models\Project;
use App\Models\RequestQuote;
use App\Services\ProjectCompletionDocumentService;
use Barryvdh\DomPDF\Facade\Pdf;
use FiveamCode\LaravelNotionApi\NotionFacade as Notion;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Routes WITHOUT locale prefix (default)

// Routes WITH locale prefix
Route::prefix('{locale}')
    ->where(['locale' => 'en|de|hu'])
    ->group(function (): void {
        Route::middleware(['auth'])->get('/', fn () => redirect()->route('filament.dashboard.pages.dashboard'))->name('home');

        Route::get('/form/expired', fn (): View|Factory => view('form.expired'))->name('form.expired');

        Route::get('arajanlat', GuestShowQuaotationForm::class)->name('quotation');

        Route::get('pdf/{requestQuote}', function (RequestQuote $requestQuote): View|Factory {
            return view('pdf.quotation-user', ['requestQuote' => $requestQuote]);
        })->name('quotation.pdf');

        // Project PDF routes
        Route::middleware([])->prefix('project-pdf')->name('project.pdf.')->group(function (): void {

            Route::get('/completion/{project}', function ($projectId): Response {
                $project = Project::query()->findOrFail($projectId);
                $service = new ProjectCompletionDocumentService($project);

                return $service->generatePdf();
            })->name('completion');

            Route::get('/storage/{project}', function ($projectId) {
                $project = Project::query()->findOrFail($projectId);
                $service = new ProjectCompletionDocumentService($project);
                $filename = $service->savePdfToStorage();

                // Use Storage::path() to get the correct absolute path according to the disk configuration
                return response()->file(Storage::path($filename));
            })->name('storage');

            Route::get('/maintenance-contract/{project}', function ($projectId): Response {
                $project = Project::query()->findOrFail($projectId);

                // Prepare data for PDF (project and quote data available but not displayed)
                $data = [
                    'project' => $project,
                    'request_quote' => $project->requestQuote,
                    'client' => $project->user,
                    'contact_person' => $project->contact,
                    'order' => $project->order,
                    'support_pack' => $project->supportPack,
                    'document_generated_at' => now(),
                ];

                // Generate PDF dynamically
                $pdf = Pdf::loadView('pdf.maintenance-contract', $data);
                $pdf->setPaper('A4', 'portrait');

                return $pdf->stream('maintenance-contract-'.$project->id.'.pdf');
            })->name('maintenance-contract');

            Route::get('/maintenance-quote/{project}', function ($projectId): Response {
                $project = Project::query()->findOrFail($projectId);

                // Prepare data for PDF
                $data = [
                    'project' => $project,
                    'request_quote' => $project->requestQuote,
                    'client' => $project->user,
                    'contact_person' => $project->contact,
                    'order' => $project->order,
                    'support_pack' => $project->supportPack,
                    'document_generated_at' => now(),
                ];

                // Generate PDF dynamically
                $pdf = Pdf::loadView('pdf.maintenance-quote', $data);
                $pdf->setPaper('A4', 'portrait');

                return $pdf->stream('maintenance-quote-'.$project->id.'.pdf');
            })->name('maintenance-quote');

            Route::get('/website-data/{project}', function ($projectId): View|Factory {
                $project = Project::query()->findOrFail($projectId);

                return view('project.website-data', [
                    'project' => $project,
                    'requestQuote' => $project->requestQuote,
                ]);
            })->name('website-data');

        });

        Route::name('quotation.')->prefix('quotation')->group(function (): void {

            Route::get('preview/{requestQuote}', function (RequestQuote $requestQuote): View|Factory {
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

        require __DIR__.'/auth.php';

    });
