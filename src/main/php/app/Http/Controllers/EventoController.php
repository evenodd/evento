<?php

namespace App\Http\Controllers;

use App\Evento;
use Auth;
use DB;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        /**
         * Use this if middleware is shitty
         */

        // if(!Auth::check())
        //     return response('Permission Denied', '403');

        return DB::table('eventos_owners')
            ->select('title', 'description', 'start_time', 'end_time', 'venue')
            ->where('user', Auth::user()->id)
            ->join('eventos', 'eventos_owners.evento', '=', 'eventos.id')
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

        DB::table('eventos')->insert([
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
     * @param  \App\Evento  $Evento
     * @return \Illuminate\Http\Response
     */
    public function show(Evento $evento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Evento  $Evento
     * @return \Illuminate\Http\Response
     */
    public function edit(Evento $evento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $Evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Evento $evento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Evento  $Evento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evento $evento)
    {
        //
    }
}
