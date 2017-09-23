<?php

namespace App\Http\Controllers;

use App\Evento;
use App\Rsvp;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Traits\StoresRsvps;

class EventoController extends Controller
{
    use StoresRsvps;
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
        return Evento::where('event_planner', Auth::user()->id)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'start-datetime' => 'required|after:now',
            'end-datetime'=> 'required|after:start-datetime',
            'rsvp-datetime'=> 'nullable|before:start-datetime|after:now',
            'public-private' =>  array('required', 'regex:/public|private/'),
            'price' => 'nullable|numeric|min:0.01',
            'guests-list' => 'array|nullable',
            'guests-list.*' => 'email',
            'max-guests' => 'nullable|min:1|integer'
        ],
        //Error messages to use
        [
            'title.required' => 'A title is required',
            'description.required'  => 'A message is required',
            'start-datetime.required' => 'A start datetime is required',
            'start-datetime.after' => 'The event start date/time must be in the future',
            'rsvp-datetime.before' => 'The "rsvp" date/time must be in the future',
            'rsvp-datetime.after' => 'The "rsvp" date/time must be before the start of the event',
            'end-datetime.required' => 'A "To" date is required',
            'end-datetime.after' => 'The "To" date must be after the "From" date',
            'price.numeric' => 'The price is not a valid number',
        ]);

        $preferences = new \stdClass();
        
        if ($req->has('seats'))
            $preferences->seats = $req->input('seats');
        
        $evento = new Evento();
        $evento->title = $req->input('title');
        $evento->event_planner = Auth::user()->id;
        $evento->description = $req->input('description');
        $evento->start_datetime = $req->input('start-datetime');
        $evento->end_datetime = $req->input('end-datetime');
        $evento->rsvp_datetime = $req->has('rsvp-datetime') ? $req->input('rsvp-datetime') : null;
        $evento->max_guests = $req->has('max-guests') ? $req->input('max-guests') : null;
        $evento->venue = $req->input('venue');
        $evento->host_name = $req->has('host-name') ? $req->input('host-name') : null;
        $evento->host_email = $req->has('host-email') ? $req->input('host-email') : null;
        $evento->from_host = $req->has('from-host-checkbox') ? $req->input('from-host-checkbox') : false;
        $evento->preferences = json_encode($preferences);
        $evento->price = $req->has('price') ?  $req->input('price') : null;
        $evento->private = ($req->input('public-private') === 'private');
        $evento->save();

        if ($req->has('guests-list'))
            $this->storeRsvp(new Request([
            'guests-list' => $req->input('guests-list'),
            'event' => $evento->id
        ]));

        return [
            'id' => $evento->id,
            'event' => $evento, 
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
        return view('event.details', ['event' => $evento]);
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

    /**
     * Cancels the event, notifying all guests via email
     *
     * @param  \App\Evento  $Evento
     * @return \Illuminate\Http\Response
     */
    public function cancel(Evento $evento) {
        $this->authorize('update', $evento);
        $evento->canceled = true;
        //get all the rsvps that have already been sent
        $rsvps = getRsvps(new Request(['sent' => true]), $evento);
        foreach ($rsvps as $rsvp) {
            dispatch(new SendGuestEmail($rsvp, 'emails.canceled'));
        }
    }

    
    /**
     * Returns the number of guests added to the event
     * (does not care if guests accepted invitation or not)
     * @param  \App\Evento  $Evento
     * @return int
     */
    public function getNumberOfGuests(Evento $evento) {
        $this->authorize('view', $evento);
        return RSVP::where('event', $evento->id)->count();
    }

    public function getRsvps(Request $req, Evento $evento) {
        $this->authorize('view', $evento);
        $this->validate($req, [
            'sent' => 'boolean'
        ]);

        //Get all rsvps for this event
        $rsvps = RSVP::where('event', $evento->id);
        //filter by sent if requested
        if($req->has('sent'))
            $rsvps = $rsvps->where('sent', $req->input('sent'));

        return $rsvps->get();
    }
}
