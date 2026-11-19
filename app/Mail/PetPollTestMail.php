<?php

namespace App\Mail;

use App\Models\PetPoll;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PetPollTestMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public PetPoll $poll
    ) {}

    public function envelope(): Envelope
    {
        $from = null;
        if (!empty($this->poll->sender_email)) {
            $from = new Address(
                $this->poll->sender_email,
                $this->poll->sender_name ?: config('mail.from.name')
            );
        }

        return new Envelope(
            from: $from,
            subject: 'Uji Pengiriman Email Survei Pet Friendly | Mal Bali Galeria',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pet_poll_test',
        );
    }
}
