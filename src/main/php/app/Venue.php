<?php

namespace App;

use App\Evento;
use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    public function getNbOfEvents() {
    	return Evento::where('venue', $this->id)
    	->where('end_datetime', '>', date("Y-m-d H:i:s"))
    	->count();
    }
}
