<?php

namespace App\Http\Controllers;

use App\Rsvp;
use App\Evento;
use Illuminate\Http\Request;
use App\Jobs\SendInvitationEmail;
use App\Traits\StoresRsvps;

class RsvpController extends Controller
{
    use StoresRsvps;

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

    public function send(Request $req, int $id) {
        $rsvp = Rsvp::findOrFail($id);
        // check user is allowed to edit an rsvp
        $this->authorize('update', $rsvp);
        $rsvp->email_token = bin2hex(random_bytes(64));
        $rsvp->sent = true;
        $rsvp->save();
        dispatch(new SendInvitationEmail($rsvp));
        return $rsvp;
    }
}