<?php

namespace App\Http\Controllers;

use App\Booking;
use Auth;
use DB;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return DB::table('bookings_owners')
            ->select('title', 'description', 'start_time', 'end_time', 'venue')
            ->where('user', Auth::user()->id)
            ->join('bookings', 'bookings_owners.booking', '=', 'bookings.id')
            ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        if($req->has('newVenue'))
            VenueController::store($req);

        DB::table('bookings')->insert([
            'preferences' => json_encode($req->input('preferences')),
            'title' => $req->input('title'),
            'description' => $req->input('description'),
            'start_time' => $req->input('start_time'),
            'end_time' => $req->input('end_time'),
            'rsvp_time' => $req->input('rsvp_time'),
            'max_guests' => $req->input('max_guests'),
            'private' => $req->input('private'),
            'venue' => $req->input('venue'),
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Booking  $booking
     * @return \Illuminate\Http\Response
     */
    public function destroy(Booking $booking)
    {
        //
    }
}
