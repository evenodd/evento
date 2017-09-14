<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\GuestInvitation;
use App\Evento;
use App\User;

class SendInvitationEmail implements ShouldQueue
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
        $this->event = Evento::find($rsvp->event);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        Mail::to($this->rsvp->email)
            ->send(new GuestInvitation($this->rsvp, $this->event));
    }
}
