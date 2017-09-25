<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Evento;
use App\Traits\StoresRsvps;

class PublicController extends Controller
{
    public function index(Request $req) {
    	return Evento::where('private', false)
    		->where('canceled', false)
    		->get();
    }
}
