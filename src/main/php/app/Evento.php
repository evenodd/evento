<?php

namespace App;

use App\Rsvp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HidesAttributes;


class Evento extends Model
{
    use HidesAttributes;

    public function getNumberOfGuests() {
        // Get all the rsvps, filter out the ones where accepted is false
        // or doesn't exist and count how many are left.
        return $this->getRsvps()->filter(function($rsvp) {
            $preferences = json_decode($rsvp->preferences);
            return property_exists($preferences, 'accepted') && $preferences->accepted;
        })->count();
    }

    public function getRsvps(bool $sent = null) {
        //Get all rsvps for this event
        $rsvps = Rsvp::where('event', $this->id);
        //filter by sent if defined
        if(!is_null($sent)) {
            $rsvps = $rsvps->where('sent', $sent);
        }

        return $rsvps->get();
    }


    public function hasSeats() {
        return property_exists((json_decode($this->preferences)), 'seats');
    }

    public function getSeats() {
        return json_decode($this->preferences)->seats;
    }
    //
}
