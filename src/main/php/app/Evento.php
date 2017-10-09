<?php

namespace App;

use App\Rsvp;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HidesAttributes;


class Evento extends Model
{
    use HidesAttributes;

    public function getNumberOfGuests() {
        return $this->getRsvps()->filter(function($rsvp) {
            return json_decode($rsvp->preferences)->accepted;
        })->count();
    }

    public function getRsvps(bool $sent = null) {
        //Get all rsvps for this event
        $rsvps = RSVP::where('event', $this->id);
        //filter by sent if defined
        if(!is_null($sent))
            $rsvps = $rsvps->where('sent', $sent);

        return $rsvps->get();
    }
    //
}
