<?php

namespace App\Http\Controllers;
use DB;
use App\Venue;
use Auth;
use Illuminate\Http\Request;
use App\Evento;

class VenueController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    //     $this->middleware('auth');
    }

    // THIS is the best code in the whole project
    public function getVenue(Venue $venue)
    {
        return $venue;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $query = Venue::where('enabled', true);
        // filter venues to only include the user's venues if requested
        if($req->has('owner') && $req->input('owner') === 'self')
            $query = $query->where('owner', Auth::user()->id);

        return $query->orderBy('name', 'asc')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return create venue view
       $this->authorize('create', Venue::class);
        return view('venue.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        //check user can create from VenuePolicy
       $this->authorize('create', Venue::class);
        // Validation rules
        $this->validate($req,
        [
            'venueName' => 'required|string|max:255',
            'address-number' => 'string|nullable',
            'street-name' => 'string|nullable',
            'city' => 'string|nullable',
            'state' => 'string|nullable',
            'postcode' => 'string|nullable',
            'country' => 'string|nullable',
            'max-capacity' => 'required|int|min:1',
            'contacts' => 'json|notIn:{}',
        ],
        //Error messages to use
        [
            'venueName.required' => 'A venue name is required',
            'max-capacity.required'  => 'invalid max-capacity',
            'contacts.*' => 'Contact information is required'
        ]);
        
        
        $address =   ($req->has('address-number') ? $req->input('address-number') : '') . ' '
                   . ($req->has('street-name')    ? $req->input('street-name') : '') . ' '
                   . ($req->has('city')           ? $req->input('city') : '') . ' '
                   . ($req->has('state')          ? $req->input('state') : '') . ' '
                   . ($req->has('postcode')       ? $req->input('postcode') : '') . ' '
                   . ($req->has('country')        ? $req->input('country') : '') . ' ';

        $venue = new Venue();

        $venue->name = $req->input('venueName');
        $venue->owner = Auth::user()->id;
        $venue->address = $address;
        $venue->contact = $req->input('contacts');
        $venue->capacity = $req->input('max-capacity');

        $venue->save(); 

        return [
            'id' => $venue->id , 
            'venue' => $venue,
            'status' => 'success', 
            'msg' => 'Venue "' . $venue->name . '" created successfully'
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        return view('venue.details', ['venue' => $venue]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
        $this->authorize('update', $venue);
        return view('venue.edit', ['venue' => $venue]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, Venue $venue)
    {
        $this->authorize('update', $venue);
        $this->validate($req,
        [
            'name' => 'required|string|max:255',
            'address' => 'string|nullable',
            'capacity' => 'required|int|min:1',
            'contact' => 'json|notIn:{}',
        ],
        //Error messages to use
        [
            'venueName.required' => 'A venue name is required',
            'max-capacity.required'  => 'invalid max capacity',
            'contacts.*' => 'Contact information is required'
        ]);

        $venue->name = $req->name;
        $venue->address = $req->address;
        $venue->capacity = $req->capacity;
        $venue->contact = $req->contact;
        $venue->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        //
    } 

    public function getEvents(Venue $venue) {
        $this->authorize('view', $venue);

        return Evento::where('venue', $venue->id)
            ->orderBy('start_datetime', 'asc')
            ->get();
    }

    public function getEventDetails(Venue $venue, Evento $evento) {
        $this->authorize('view', $venue);
        $this->authorize('viewSummary', [$evento, $venue]);

        $evento->setVisible(
            ['id', 'title', 'description', 'start_datetime', 'end_datetime', 
            'rsvp_datetime', 'venue']
        );

        return view('event.details', [
            'event' => $evento           
        ]);
    }

    public function cancel(Venue $venue) {
        $this->authorize('update', $venue);
        // returns an error if future events for this venue exists
        if($venue->getNbOfEvents())
            return response([
                'hasEvents' => "You cannot cancel a venue when there are still events for it."
            ], 422);

        $venue->enabled = false;
        $venue->save();
    }
}
