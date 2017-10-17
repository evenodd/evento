@extends('layouts.app')

@section('script')
<script src="{{ asset('js/rsvp/rsvp.js') }}"></script>
@endsection

@section('content')
<div id="eventData" data-event="{{ $event }}"></div>
<div id="rsvpData" data-rsvp="{{ $rsvp }}"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @component('components.alerts')
            @endcomponent
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
                    <hr>
                    <form id="sendRSVP" method="POST" action="/storeRsvpResponse/{{$rsvp->id}}">
                        {{ csrf_field() }}
                        <!-- here is where the options would go, if we had any

                            <input type="text" name="in_it_is"> -->
                        @if($event->hasSeats())
                            <event-seats-form 
                                id="eventSeats" 
                                :event="event"
                                v-model="rsvp.preferences.seats"
                                url="/eventos/details/">
                            </event-seats-form>
                        @endif
                        <div class="text-right">
                            <button v-on:click.prevent="onSubmit" class="btn btn-primary">RSVP To Event</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection