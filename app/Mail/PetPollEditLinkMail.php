<?php

namespace App\Mail;

use App\Models\PetPollResponse;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PetPollEditLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PetPollResponse $response
    ) {}

    public function envelope(): Envelope
    {
        $from = null;
        if (!empty($this->response->poll?->sender_email)) {
            $from = new Address(
                $this->response->poll->sender_email,
                $this->response->poll->sender_name ?: config('mail.from.name')
            );
        }

        return new Envelope(
            from: $from,
            subject: 'Tautan Ubah Jawaban Survei Pet Friendly | Mal Bali Galeria',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pet_poll_edit_link',
        );
    }
}
