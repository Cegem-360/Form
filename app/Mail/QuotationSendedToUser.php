<?php

declare(strict_types=1);

namespace App\Mail;

use App\Models\RequestQuote;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QuotationSendedToUser extends Mailable
{
    use Queueable, SerializesModels;

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
            subject: 'Quotation Sended To User',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'mail.quotation-sended-to-user',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): Attachment
    {
        $pdf = Pdf::loadView('pdf.quotation-user', ['requestQuote' => $this->requestQuote]);

        return Attachment::fromData(fn () => $pdf->output(), 'quotation.pdf')
            ->as('quotation.pdf')
            ->withMime('application/pdf');
    }
}
