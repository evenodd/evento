<?php

namespace App\Http\Controllers;
 
use App\Evento;
use App\Rsvp;
use App\Venue;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Traits\StoresRsvps;
use App\Traits\GetsEventSeats;
use App\Jobs\SendGuestEmail;

class EventoController extends Controller
{
    use StoresRsvps;
    use GetsEventSeats;
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
        return Evento::where("event_planner", Auth::user()->id)
            ->orWhere("host_email", Auth::user()->email)
            ->orderBy('start_datetime', 'asc')
            ->get();
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
        $temp_cap = Venue::findOrFail($req->venue)->capacity;
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
            'max-guests' => 'nullable|min:1|integer|max:' . $temp_cap
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
            'max-guests.max' => 'Too many people for the venue'
        ]);
        //Comparison for 709 goes here
        /* // Broken/unfinished code
        if(Venue::findOrFail($evento->venue)->capacity > 'max-guests')
            'max-guests' => $req->input('max-guests'),*/


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
            $this->storeRsvp($req->input('guests-list'), $evento);

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
        return view('event.edit', ['event' => $evento]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Evento  $Evento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Evento $evento)
    {
        $this->authorize('update', $evento);
        $temp_cap = Venue::findOrFail($req->venue)->capacity;
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
            'max-guests' => 'nullable|min:1|integer|max:' . $temp_cap
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
            'max-guests.max' => 'Too many people for the venue'
        ]);

        // validate change in guests (accepted guests cannot be removed)
        $guestValidator = $this->_validateGuestChange(
            $req->input('guests-list'),
            $evento
        );

        if(!$guestValidator['verified'])
            return response([
                'guests' => 
                    'You cannot remove these guests from the list as they ' .
                    'have already accepted your invitation: 
                    ' .
                    implode(', ', $guestValidator['missing'])
            ], 422);

        // validate seats (reserved seats cannot be removed)
        $seatsValidator = $this->_validateSeatsChange(
            $req->input('seats'),
            $evento
        );

        if(!$seatsValidator['verified'])
            return response([
                'seats' => 
                    'You cannot remove these seats  as guests have already ' . 
                    'reserved them: 
                    ' .
                    implode(', ', $seatsValidator['missing'])
            ], 422);

        // validate max guests (max guests cannot be under current attending guests)
        $numAttending = $evento->getNumberOfGuests();
        if(
            $req->has('max-guests') && 
            $req->input('max-guests') && 
            $numAttending > $req->input('max-guests')
        )
            return response([
                'max-guests' => 'Your max guests value is too low. As ' . 
                $numAttending . ' guest(s) have already accepted invitations ' .
                'to this event.'
            ], 422); 

        $preferences = new \stdClass();
        
        if ($req->has('seats'))
            $preferences->seats = $req->input('seats');

        //save new details
        $evento->title = $req->input('title');
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

        $rsvps = $evento->getRsvps();

        if ($req->has('guests-list'))
            $this->storeRsvp(
                array_diff(
                    $req->input('guests-list'),
                    $rsvps->map(function($rsvp) {
                        return $rsvp->email;
                    })->toArray()
                ),
                $evento
            );

        $sentRsvps = $rsvps->filter(function($rsvp) {
            return $rsvp->sent;
        });
        
        //send update emails to guests
        foreach ($sentRsvps as $rsvp) {
            dispatch(
                new SendGuestEmail($rsvp, 'emails.updated', "Updated: ")
            );
        }
    }

    // Validates that all the required rsvps are still in the guests list.
    // returns an object with a boolean property 'verified'.
    // If the reguest isn't verified the function will return an array of 
    // missing emails within the returned object's 'missing' property.
    private function _validateGuestChange($rsvps, $evento) {
        if(!$evento->hasSeats())
            return['verified' => true, 'missing' => array()];

        $requiredRsvps = $evento->getRsvps()
            ->filter(function($rsvp) {
                $preferences = json_decode($rsvp->preferences);
                return property_exists($preferences, 'accepted') && 
                       $preferences->accepted;
            })
            ->map(function($rsvp){
                return $rsvp->email;
            });

        $missing = [];

        foreach ($requiredRsvps as $requiredRsvp) {
            if(!in_array($requiredRsvp, $rsvps))
                array_push($missing, $requiredRsvp);
        }
        return [
            'verified' => (count($missing) == 0),
            'missing' => $missing
        ];

    }

    private function _validateSeatsChange($seats, $evento) {
        $currSeats = $this->getSeats($evento);
        $missing = [];

        foreach ($currSeats['booked'] as $seat) {
            if(!in_array($seat, $seats))
                array_push($missing, $seat);
        }
        return [
            'verified' => (count($missing) == 0),
            'missing' => $missing
        ];
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
        $rsvps = $evento->getRsvps();

        foreach ($rsvps as $rsvp) {
            dispatch(
                new SendGuestEmail($rsvp, 'emails.canceled', "Canceled: ")
            );
        }
        $evento->save();
        return redirect('/eventos/details/' . $evento->id);
    }

    
    /**
     * Returns the number of guests who have accepted
     * an invitation to the event
     * @param  \App\Evento  $Evento
     * @return int
     */
    public function getNumberOfGuests(Evento $evento) {
        $this->authorize('viewSummary', [
            $evento, 
            Venue::findOrFail($evento->venue)
        ]);
        return $evento->getNumberOfGuests();
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
