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

class SendGuestEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    protected $rsvp;
    protected $event;
    protected $view;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($rsvp, $view)
    {
        $this->rsvp = $rsvp;
        $this->event = Evento::find($rsvp->event);
        $this->view = $view;
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
                $this->rsvp, 
                $this->event, 
                $this->view
            ));
    }
}
