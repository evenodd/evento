@extends('layouts.app')

@section('script')
<script src="{{ asset('js/home/home.js') }}"></script>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>RSVP</b>
                </div>
                <div class="panel-body">
                  <p> I, <b>{{Auth::user()->name}}</b> would like to RSVP to the event <b> Wedding at Stephanos </b> </p>
                  <hr>
                   
                        <p> Event Time : <b> 20/01/2017 3.30pm to 21/01/2017 1.00am </b></p>
                        <p> Venue : <b> <a href="#">UTS, 21 somewhere st Australia</a></b></p>
                        <p> Ticket Price : <b> $30.00 </b></p>
                        <p> Description : <b> just another fun birthday party for myself </b></p>
                      
                       
                    <hr>
                   <form class="form-horizontal" method="POST" >

                        {{ csrf_field() }}

                    
                    <p> <b> Jims Catering: </b> </p>
                    <ul class="nav nav-pills nav-stacked">               
                        <li role="presentation">
                            <div class="row">
                                <a href="#">
                                    <div class=" col-xs-4 "> <b> Main Meal: </b> Duck Soup 
                                    </div>
                                    <div class="col-xs-4 text-right"> <b> Price: </b> $30.00 
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <b> Order: </b><input type="checkbox">
                                    </div>
                                </a> 
                            </div>
                        </li>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <a href="#" data-toggle="modal" data-target="#addBookingModal" id="addBooking" class="btn btn-π btn-success center-block">
            RSVP to Event
        </a>

    </div>
</div>


  </div>
</div>

@endsection
