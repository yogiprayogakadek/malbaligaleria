<?php

namespace App\Mail;

use App\Models\JobApplication;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class NewJobApplicationNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public JobApplication $application
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '[HR] New Application — ' . $this->application->vacancy->title,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.new_job_application_notification',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $attachments = [];

        // Attach CV if it exists in storage
        if ($this->application->cv_path && Storage::disk('public')->exists($this->application->cv_path)) {
            $extension = pathinfo($this->application->cv_path, PATHINFO_EXTENSION) ?: 'pdf';
            $cvName = 'CV_' . Str::slug($this->application->name) . '.' . $extension;

            $attachments[] = Attachment::fromStorageDisk('public', $this->application->cv_path)
                ->as($cvName);
        }

        // Attach Cover Letter as a text document if present
        if ($this->application->cover_letter) {
            $coverLetterContent = "COVER LETTER\n\n"
                . "Applicant Name : " . $this->application->name . "\n"
                . "Email          : " . $this->application->email . "\n"
                . "Phone          : " . $this->application->phone . "\n"
                . "Position       : " . $this->application->vacancy->title . "\n"
                . "Date           : " . $this->application->created_at->format('d M Y, H:i') . "\n"
                . "--------------------------------------------------\n\n"
                . $this->application->cover_letter;

            $fileName = 'Cover_Letter_' . Str::slug($this->application->name) . '.txt';

            $attachments[] = Attachment::fromData(fn () => $coverLetterContent, $fileName)
                ->withMime('text/plain');
        }

        return $attachments;
    }
}
