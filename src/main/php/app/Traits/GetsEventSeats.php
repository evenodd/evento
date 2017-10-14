<?php namespace App\Traits;

use Illuminate\Http\Request;
use App\Rsvp;
use App\Evento;

trait getsEventSeats{
	public function getSeats(Evento $evento) {
        if ($evento->private)
            $this->authorize('view', $evento);
        
        $preferences = json_decode($evento->preferences);
        //check seats preference exists and is not empty
        if( !property_exists($preferences, 'seats') ||
            !is_array($preferences->seats) ||
            count($preferences->seats) <= 0
        )
            return [
                'available' => [],
                'booked' => []
            ];

        // get all the rsvps and map them to the seats they booked
        // this will create an array of booked seats
        $booked = $evento->getRsvps()->map(function($rsvp) {
                $rsvpPreferences =  json_decode($rsvp->preferences);
                if (!property_exists($rsvpPreferences, 'seats'))
                    return -1; // just hopin a seat will never equal this. 
                return $rsvpPreferences->seats;
            })
            // remove all the rsvps that dont have seats
            ->filter(function($seat) {
                return $seat != -1 && $seat != '';
            })  
            ->toArray();
        // any seats that are not in the booked array must be available.
        // so make 'available' the difference between the seats and booked array
        $available = array_diff($preferences->seats, $booked);

        return [
            'available' => $available,
            'booked' => $booked
        ];
    }
}