<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\EmailVerification;

class SendInivitationEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $rsvp;
    protected $event;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($rsvp)
    {
        $this->rsvp = $rsvp;
        $this->event = App/Evento::find($rsvp->event);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $address = $this->event->from_host ? $this->event->host_email : App/User::get($this->event->event_planner)->email;
        $name = $this->event->from_host ? $this->event->host_name : App/User::get($this->event->event_planner)->name;
        Mail::to($this->rsvp->email)
            ->from(['address' => $address, 'name' => $name . " (Evento)"])
            ->send(new GuestInvitation($this->rsvp, $this->event));
    }
}
