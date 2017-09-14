<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;


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
        $address = $this->event->from_host ? $this->event->host_email : User::find($this->event->event_planner)->email;
        $name    = $this->event->from_host ? $this->event->host_name  : User::find($this->event->event_planner)->name;

        return $this->markdown('emails.invitation')
                    ->with(['rsvp' => $this->rsvp, 'event' => $this->event])
                    ->subject($this->event->title . '(Evento)')
                    ->from($address, $name);
    }
}
