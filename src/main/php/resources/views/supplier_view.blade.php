@extends('layouts.app')

@section('script')
<script src="{{ asset('js/home/home.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">        
                <div class="panel-heading"><b>Supplier View</b></div>
                <div class="panel-body">
                    <p>You are logged in as : <b> Jims Catering </b></p>
                    <ul class="nav nav-pills nav-stacked">
                                      
                        <li role="presentation">
                            <div class="row">
                                <a href="#">
                                    <div class=" col-xs-4 "> <b>Main Meal: </b> Duck Soup</div>
                                    <div class="col-xs-4 text-right"> <b> Price </b> $30.00 x 
                                        <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs"><span class="badge" name="event-guest-nb">5 </span> Guests</button></span>
                                        = $150.00
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <button> Click For Details </button>
                                    </div>
                                </a> 
                            </div>
                        </li>

                        <hr>

                         <li role="presentation">
                            <div class="row">
                                <a href="#">
                                    <div class=" col-xs-4 "> <b>Buffet: </b> Vegetariann </div>
                                    <div class="col-xs-4 text-right"> <b> Price </b> $900.00 x 
                                        <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs"><span class="badge" name="event-guest-nb"> 1</span> Event </button></span>
                                        = $900.00
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <button> Click For Details </button>
                                    </div>
                                </a> 
                            </div>
                        </li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
