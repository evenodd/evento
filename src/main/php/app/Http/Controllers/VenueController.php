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
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Venue::where('enabled', true)->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return create venue view
       // $this->authorize('create', Venue::class);
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
        //check user can creat VenuePolicy

        // Validation rules
        $this->validate($req,
        [
            'venueName' => 'string|max:255',
            'address-number' => 'string',
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
            'venueName.required' => 'A title is required',
            'description.required'  => 'invalid description',
            'address-number.required' => 'A address-number is required',
            'street-name.required' => 'A street-name is required',
            'city.required' => 'A city is required',
            'state.required' => 'A state is required',
            'postcode.required' => 'A postcode is required',
            'country.required' => 'A country is required',
            'max-capacity.required'  => 'invalid max-capacity',
            'contacts.*' => 'Contact information is required'
        ]);
        
        
        $address = $req->input('address-number') . ' '
                   . $req->input('street-name') . ' '
                   . $req->input('city') . ' '
                   . $req->input('state') . ' '
                   . $req->input('postcode') . ' '
                   . $req->input('country');


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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
        //
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

        return Evento::where('venue', $venue->id)->get();
    }
}
