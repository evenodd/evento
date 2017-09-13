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
            ->select('title', 'description', 'start-datetime', 'end-datetime', 'venue')
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
        // $this->authorize('create', Evento::class);
        $this->authorize('create', Evento::class);
        return view('event.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //Check user can make an event
        $this->authorize('create', Evento::class);
        $this->validate($req, 
        // Validation rules
        [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'start-datetime' => 'required',
            'end-datetime'=> 'required|after:start-datetime',
            'public-private' =>  array('required', 'regex:/public|private/'),
            'price' => 'nullable|float'
        ],
        //Error messages to use
        [
            'title.required' => 'A title is required',
            'description.required'  => 'A message is required',
            'start-datetime.required' => 'A start datetime is required',
            'end-datetime.required' => 'A "To" date is required',
            'end-datetime.after' => 'The "To" date must be after the "From" date',
        ]);

        $preferences = new \stdClass();
        
        if ($req->has('seats'))
            $preferences->seats = $req->input('seats');
        
        $id = DB::table('eventos')->insert([
            'title' => $req->input('title'),
            'event_planner' => Auth::user()->id,
            'description' => $req->input('description'),
            'start_datetime' => $req->input('start-datetime'),
            'end_datetime' => $req->input('end-datetime'),
            'rsvp_datetime' => $req->has('rsvp-datetime') ? $req->input('rsvp-datetime') : null,
            'max_guests' => $req->has('max-guests') ? $req->input('max-guests') : null,
            'venue' => $req->input('venue'),
            'host_name' => $req->has('host-name') ? $req->input('host-name') : null,
            'host_email' => $req->has('host-email') ? $req->input('host-email') : null,
            'from_host' => $req->has('from-host-checkbox') ? $req->input('from-host-checkbox') : false,
            'preferences' => json_encode($preferences),
            'price' => $req->has('price') ?  $req->input('price') : null,
            'private' => ($req->input('public-private') === 'private'),
        ]);

        return [
            'id' => $id, 
            'status' => 'success', 
            'msg' => 'Event "' . $req->input('title') . '" created successfully'
        ];
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
