<?php namespace App\Traits;

use Illuminate\Http\Request;
use App\Rsvp;
use App\Evento;

trait storesRsvps{

	/**
     * Store a newly created rsvp in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function storeRsvp(Request $req)
    {
        // check user has permissions to create a RSVP
        $this->authorize('create', Rsvp::class);

        // check request is valid
        $this->validate($req, [
            'guests-list' => 'required|array|min:1',
            'guests-list.*' => 'email',
            'event' => 'required|exists:eventos,id'
        ]);

        $event = Evento::findOrFail($req->input('event'));

        // check user has permissions to edit the event the RSVPs are for
        $this->authorize('update', $event);


        $preferences = new \stdClass();
        $preferences->accepted = false;

        if($event->hasSeats()) 
            $preferences->seats = null;

        foreach ($req->input('guests-list') as $email) {
            // add rsvp to db
            $rsvp = new Rsvp();
            $rsvp->email = $email;
            $rsvp->preferences = json_encode($preferences);
            $rsvp->event = $req->input('event');
            $rsvp->email_token = null;
            $rsvp->sent = false;
            $rsvp->save();
        }

    }

} 