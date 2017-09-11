<?php

namespace App\Http\Controllers;

use App\Rsvp;
use App\Evento;
use Illuminate\Http\Request;

class RsvpController extends Controller
{
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
        // check user has permissions to create a RSVP
        $this->authorise('create', Rsvp::class)

        // check request is valid
        $this->validate($req, [
            'guests-list' => 'required|array|min:1',
            'guests-list.*' => 'email',
            'event' => 'required|exists:eventos,id'
        ]);

        // check user has permissions to edit the event the RSVPs are for
        $this->authorise('update', Evento::find($req->input('event')))


        foreach ($req->input('guests-list') as $email) {
            // add rsvp to db
            $preferences = new \stdClass();
            $preferences->accepted = false;
            $rsvp = new Rsvp();
            $rsvp->email = $email;
            $rsvp->preferences = json_encode($preferences);
            $rsvp->event = $req->input('event');
            $rsvp->email_token = null;
            $rsvp->sent = false;
            $rsvp->save();
        }

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

    public function send(Rsvp $rsvp) {
        $this->authorise->('update', $rsvp);

        
    }
}
