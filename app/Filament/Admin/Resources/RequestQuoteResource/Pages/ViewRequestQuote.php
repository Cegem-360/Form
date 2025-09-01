<?php

declare(strict_types=1);

namespace App\Filament\Admin\Resources\RequestQuoteResource\Pages;

use App\Filament\Admin\Resources\RequestQuoteResource;
use App\Mail\QuotationSendedToUser;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

final class ViewRequestQuote extends ViewRecord
{
    protected static string $resource = RequestQuoteResource::class;

    public function createPdf()
    {
        $record = $this->record;

        return redirect()->route('quotation.preview', ['requestQuote' => $record->id]);
    }

    public function createPdfAndSendToCurrentUser(): void
    {
        $record = $this->record;
        Mail::to(Auth::user()->email)->send(new QuotationSendedToUser($record));
        Notification::make()
            ->title('Quotation has been sent to your email')
            ->success()
            ->send();
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
            DeleteAction::make(),
            Action::make('createPdf')
                ->label('Árajánlat megtekintése')
                ->action('createPdf')
                ->color('primary'),

        ];
    }
}
