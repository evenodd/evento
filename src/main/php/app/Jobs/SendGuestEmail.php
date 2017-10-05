<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;
use App\Mail\GuestMail;
use App\Evento;
use App\User;
use App\Venue;

class SendGuestEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $rsvp;
    protected $event;
    protected $view;
    protected $subject;
    protected $venue;
    // protected $name;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($rsvp, $view, $subject = "")
    {
        $this->rsvp = $rsvp;
        $this->event = Evento::find($rsvp->event);
        $this->view = $view;
        $this->subject = $subject;
        $this->venue = Venue::find($this->event->venue);  // object then attribute, this mail objecct has an event which belongs to this venue.
        // $this->name= User::find($this->name);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
        Mail::to($this->rsvp->email)
            ->send(new GuestMail(
                $this->venue,
                $this->rsvp, 
                $this->event, 
                $this->view,
                $this->subject
                // $this->name
            ));
    }

    public function failed($e) 
    {
        \Log::info('Failed to send email for rsvp: ' . $this->rsvp->id);
        if($this->view == "emails.invitation"){
            $this->rsvp->email_token = null;
            $this->rsvp->sent = false;
            $this->rsvp->save();
        }
    }
}
