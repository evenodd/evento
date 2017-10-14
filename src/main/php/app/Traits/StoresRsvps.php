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
     private function storeRsvp($rsvps, $evento)
    {
        $preferences = new \stdClass();
        $preferences->accepted = false;

        foreach ($rsvps as $email) {
            // add rsvp to db
            $rsvp = new Rsvp();
            $rsvp->email = $email;
            $rsvp->preferences = json_encode($preferences);
            $rsvp->event = $evento->id;
            $rsvp->email_token = null;
            $rsvp->sent = false;
            $rsvp->save();
        }
    }
} 