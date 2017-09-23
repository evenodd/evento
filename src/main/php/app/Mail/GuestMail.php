<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;


class GuestMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $rsvp;
    protected $event;
    public $view;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($rsvp, $event, $view)
    {
        $this->rsvp = $rsvp;
        $this->event = $event;
        $this->view = $view;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->event->from_host) {
            $address =  $this->event->host_email;
            $name = $this->event->host_name;
        }
        else {
            $event_planner = User::find($this->event->event_planner);
            $address =  $event_planner->email;
            $name = $event_planner->name;
        }
        return $this->markdown($this->view)
                    ->with(['rsvp' => $this->rsvp, 'event' => $this->event])
                    ->subject($this->event->title . '(Evento)')
                    ->from($address, $name);
    }
}
