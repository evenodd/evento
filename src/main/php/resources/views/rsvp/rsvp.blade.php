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
                  <p>The holder of <b>{{ $rsvp->email }}</b> RSVP to the event <b> {{$event->title}} </b> </p>
                  <hr>
                   
                        <p> Event Time : <b> {{$event->start_datetime}} to {{$event->end_datetime}} </b></p>
                        <p> Venue : <b> <a href="#">{{$venue->name}}</a></b></p>
                        @if($event->price)
                        <p> Ticket Price : <b> ${{$event->price}} </b></p>
                        @endif
                        <p> Description : <b> {{$event->description}} </b></p>
                      

                </div>




                <form id="sendRSVP" method="POST" action="/storeRsvpResponse/{{$rsvp->id}}">
                    {{ csrf_field() }}
                    <!-- here is where the options would go, if we had any

                        <input type="text" name="in_it_is"> -->
                   
                        <a onclick="document.getElementById('sendRSVP').submit()" class="btn btn-π btn-success center-block">RSVP To Event</a>
                </form>

                

            </div>
        </div>
    </div>
</div>


@endsection