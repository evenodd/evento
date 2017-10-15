<?php

namespace App\Http\Controllers;

use App\Rsvp;
use App\Evento;
use App\Venue;
use Illuminate\Http\Request;
use App\Jobs\SendGuestEmail;
use App\Traits\GetsEventSeats;
use App\Traits\StoresRsvps;
use stdClass;

use DB;

class RsvpController extends Controller
{
    use StoresRsvps;
    use GetsEventSeats;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $req)
    {
        return $this->storeRsvp($req);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function show(Rsvp $rsvp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function edit(Rsvp $rsvp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rsvp $rsvp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rsvp  $rsvp
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rsvp $rsvp)
    {
        //
    }
 
    public function storeRsvpResponse(Request $req,  $token) {
        $rsvp = Rsvp::where('email_token', (string)$token)->firstOrFail();

        $event = Evento::findOrFail($rsvp->event);
        $preferences= new stdClass();
        if($event->max_guests && $event->getNumberOfGuests() >= $event->max_guests)
            return response(['maxguest' => 'Event is full... Please go away'], 422);
        if($event->hasSeats()) {
            $this->validate($req, [
                'rsvp.preferences.seats' => 'required|string'
            ], [
                'rsvp.preferences.seats.required' => 'You need to select an available seat'
            ]);
            if (!in_array($req->input('rsvp')['preferences']['seats'], $this->getSeats($event)['available']))
                return response('Invalid seat option', 422);
            // add request seats to the rsvp's preferences object
            $preferences->seats = $req->input('rsvp')['preferences']['seats'];
        }
        
        $preferences->accepted = true;
        $rsvp->email_token = null;
        $rsvp->preferences = json_encode($preferences);
        $rsvp->save();
    
        return [
            'id' => $rsvp->id,
            'rsvp' => $rsvp, 
            'status' => 'success', 
            'msg' => 'Rsvp successfull'
        ];

    }

    public function showSuccess() {
        return view('rsvp.rsvpsuccess');
    }

    public function receiveRsvp($token) {
        $rsvp = Rsvp::where('email_token', (string)$token)->first();
        if($token == 'usedUp' || $rsvp == null ){
            abort(404);
        }
        
        $event = Evento::find($rsvp->event);
        $venue = Venue::find($event->venue);

        if($event->rsvp_datetime && $event->rsvp_datetime < time()){
            abort(404);
        }
        // DB::table('rsvps')->where('email_token', (string)$token)->update(['email_token'=>'usedUp']);
        return view('rsvp.rsvp', ['rsvp' => $rsvp, 'event' => $event, 'venue' => $venue] );
        
       // return  view('rsvp.rsvpused');//("this invitation has already been used");
    }

    public function send(Rsvp $rsvp) {
        // check user is allowed to edit an rsvp
        $this->authorize('update', $rsvp);
        
        if($rsvp->sent)
            return response('Already been sent.', 400);
        // generate a random token
        $rsvp->email_token = bin2hex(random_bytes(64));
        // Record that the invitation is being sent
        $rsvp->sent = true;
        $rsvp->save();
        //email teh invitations
        dispatch(new SendGuestEmail($rsvp, 'emails.invitation'));
        return $rsvp;
    }
}
