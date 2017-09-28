@extends('layouts.app')

@section('script')
<script src="{{ asset('js/rsvp/rsvp.js') }}"></script>
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
                  <p><b>{{ $rsvp->email }}</b> RSVP to the event <b> {{$event->title}} </b> </p>
                  <hr>
                   
                        <p> Event Time : <b> {{$event->start_datetime}} to {{$event->end_datetime}} </b></p>
                        <p> Venue : <b> <a href="#">{{$venue->name}}</a></b></p>
                        <p> Ticket Price : <b> ${{$event->price}} </b></p>
                        <p> Description : <b> {{$event->description}} </b></p>
                      
                      	
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <a  onclick="jsfunction()" href="javascript:void(0);" data-toggle="modal" data-target="#addBookingModal" id="addBooking" class="btn btn-π btn-success center-block">
            RSVP to Event
        </a>

    </div>
</div>


  </div>
</div>

@endsection