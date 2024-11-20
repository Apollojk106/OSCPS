<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReservationStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;
    public $called;
    public $status;
    public $action;

    /**
     * Create a new message instance.
     */
    public function __construct($reservation = null, $called = null, $status = null, $action = null)
    {
        $this->reservation = $reservation;
        $this->called = $called;
        $this->status = $status;
        $this->action = $action;
    }

    public function build()
    {
        return $this->subject('Alteração no Status')
                    ->view('emails.reservation_status_changed');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reservation Status Changed',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.reservation_status_changed',
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
