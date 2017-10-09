<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Rsvp;
use App\Traits\StoresRsvps;

class PublicController extends Controller
{
    public function index(Request $req) {
    	return Evento::where('private', false)
    		->where('canceled', false)
    		->get();
    }

    public function eventDetails(Evento $evento) {
    	return view('public.eventDetails', ['event'=> $evento]);
    }

    public function postRsvp(Request $req, Evento $evento) {
        // we dont want the general public to know this event exists if private
        if($evento->private)
            abort(404);

        if($evento->max_guests && $evento->getNumberOfGuests() < $evento->max_guests)
            return response('This event is full', 422);

        $this->validate($req, 
        // Validation rules
        [
            'rsvp.email' => 'required|email|unique:rsvps,email',
            'rsvp.preferences.accepted' => 'required|boolean'
        ],
        //Error messages to use
        [
            'rsvp.email.unique' => 'This email has already been used to rsvp to this event',
            'rsvp.email.email' => "The email address you entered is invalid"
        ]);

        // create a new object called prefernces. This will be encoded into
        // a json object and then added to the rsvp.
        $preferences = new \stdClass();
        // set the accepted preference
        $preferences->accepted = (bool) $req->input('rsvp')['preferences']['accepted'];

        // create a new rsvp resource. Set its values and save in db
        $rsvp = new Rsvp();
        $rsvp->email = $req->input('rsvp')['email'];
        $rsvp->preferences = json_encode($preferences);
        $rsvp->event = $evento->id;
        $rsvp->email_token = null;
        $rsvp->sent = true;
        $rsvp->save();

        return [
            'id' => $rsvp->id,
            'rsvp' => $rsvp, 
            'status' => 'success', 
            'msg' => 'Rsvp successfull'
        ];
    }
}
