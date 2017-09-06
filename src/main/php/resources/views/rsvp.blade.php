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
                  <p> I, <b>{{Auth::guest() ? '' : Auth::user()->name}}</b> would like to RSVP to the event <b> Wedding at Stephanos </b> </p>
                  <hr>
                   
                        <p> Event Time : <b> 20/01/2017 3.30pm to 21/01/2017 1.00am </b></p>
                        <p> Venue : <b> <a href="#">Stephanos Winery Australia</a></b></p>
                        <p> Ticket Price : <b> $00.00 </b></p>
                        <p> Description : <b> finally getting married </b></p>
                      
                       
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

                        <li role="presentation">
                            <div class="row">
                                <a href="#">
                                    <div class=" col-xs-4 "> <b>  Balloons: </b> White and Red 
                                    </div>
                                    <div class="col-xs-4 text-right"> <b> Price: </b> $05.00 
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <b> Order: </b><input type="checkbox">
                                    </div>
                                </a> 
                            </div>
                        </li>

                      </ul>

                      <hr>
                      <p> <b> Seating: </b> </p>
                        <div class="modal-body">
                          <div>Avaliable Seats</div>
                          <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="First group">
                              <button type="button" class="btn btn-secondary btn-success">1A</button>
                              <button type="button" class="btn btn-secondary btn-success">4A</button>
                              <button type="button" class="btn btn-secondary btn-success">3B</button>
                              <button type="button" class="btn btn-secondary btn-success">6D</button>
                              <button type="button" class="btn btn-secondary btn-success">1E</button>
                              <button type="button" class="btn btn-secondary btn-success">4E</button>
                              <button type="button" class="btn btn-secondary btn-success">3F</button>
                              <button type="button" class="btn btn-secondary btn-success">6F</button>
                              <button type="button" class="btn btn-secondary btn-success">1G</button>
                              <button type="button" class="btn btn-secondary btn-success">4H</button>
                              <button type="button" class="btn btn-secondary btn-success">3I</button>
                              <button type="button" class="btn btn-secondary btn-success">6I </button>

                            </div>
                          </div>
                          <div>Reserved Seats</div>
                          <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group mr-2" role="group" aria-label="Second group">
                              <button type="button" class="btn btn-secondary btn-danger">2A</button>
                              <button type="button" class="btn btn-secondary btn-danger">3A</button>
                              <button type="button" class="btn btn-secondary btn-danger">1B</button>
                              <button type="button" class="btn btn-secondary btn-danger">2B</button>
                              <button type="button" class="btn btn-secondary btn-danger">1C</button>
                            </div>
                          </div>      
                        </div>

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
