<?php

namespace App\Http\Controllers;

use App\Venue;
use Illuminate\Http\Request;

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
        //
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

        //validate the $req 

        //$vebue = new Venue;
        //
        //$venue->save();
        //$venue = Venue::find($id)
         $this->validate($req, 
        // Validation rules
        [
            'venueName' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'address-number' => 'required',
            'street-name' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postcode' => 'required',
            'country' => 'required',
            'max-capacity' => 'required|int'
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
        ]);

         $address = $req->input('address-number') . ' '
                    . $req->input('street-name') . ' '
                    . $req->input('city') . ' '
                    . $req->input('state') . ' '
                    . $req->input('postcode') . ' '
                    . $req->input('country');


        /* $id = DB::table('venues')->insert([
            'name' => $req->input('venueName'),
            'address' => $address,
            'capacity' => $req->input('max-capacity')
         ]); */
        $id = DB::table('venues')->insert([
            'name' => 'noo',
            'address' => 'noon',
            'contact' => '{"not": "done"}',
            'capacity' => 1//$req->input('max-capacity')
        ]);

        return [
            'id' => $id, 
            'status' => 'success', 
            'msg' => 'Venue "' . '420' . '" created successfully'
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
        //
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
}
