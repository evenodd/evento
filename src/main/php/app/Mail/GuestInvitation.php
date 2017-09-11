<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class GuestInvitation extends Mailable
{
    use Queueable, SerializesModels;

    protected $rsvp;
    protected $event;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rsvp, $event)
    {
        $this->rsvp = $rsvp;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.invitation')
                    ->with(['rsvp' => $rsvp, 'event' => $event]);
    }
}
