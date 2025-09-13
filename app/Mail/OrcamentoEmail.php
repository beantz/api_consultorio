<?php

namespace App\Mail;

use App\Models\Orcamento;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class OrcamentoEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $orcamento;
    /**
     * Create a new message instance.
     */
    public function __construct(Orcamento $orcamento)
    {
        $this->orcamento = $orcamento;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Orçamento de Tratamento Odontologico',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'email.email',
            with: ['orcamento' => $this->orcamento]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
