<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\RequestQuote;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Spatie\Browsershot\Browsershot;

final class QuotationSendedToUser extends Mailable implements ShouldQueue
{
    use Queueable;
    use SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public RequestQuote $requestQuote) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Az Ön weboldal fejlesztési árajánlata megérkezett!',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.quotation-sended-to-user', with: [
                'requestQuote' => $this->requestQuote,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): Attachment
    {
        $template = view('pdf.quotation-user', ['requestQuote' => $this->requestQuote])->render();

        Browsershot::html($template)->savePdf(storage_path('app/public/quotation.pdf'));

        return Attachment::fromPath(storage_path('app/public/quotation.pdf'));
    }
}
