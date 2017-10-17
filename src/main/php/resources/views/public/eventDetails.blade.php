@extends('layouts.app')

@section('script')
<script src="{{ asset('js/public/eventDetails.js') }}"></script>
@endsection

@section('content')
<div id="eventData" data-event="{{ $event }}"></div>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @component('components.alerts')
            @endcomponent
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h2>{{$event->title}}</h2>
                </div>
                <div class="panel-body">
                    @if($event->description)
                    <h4>Description</h4> 
                    <h5>{{$event->description}}</h5>
                    @endif
                    <h4>Venue</h4> 
                    <h5 id="venue"><venue-display id="{{$event->venue}}"></venue-display></h5>
                    <h4> Event Time</h4> 
                    <h5>{{$event->start_datetime}} to {{$event->end_datetime}}</h5>
                    @if($event->price)
                        <h4>Ticket Price</h4> 
                        <h5>${{$event->price}}</h5>
                    @endif
                    @if($event->rsvp_datetime)
                        <h4>RSVP</h4> 
                        <h5>Please rsvp by:{{$event->rsvp_datetime}}</h5>
                    @endif
                    <div class="text-right">
                        <button 
                            id="rsvpToEvent" 
                            class="btn btn-lg btn-success"
                            data-toggle="modal"
                            data-target="#emailModal">
                            RSVP To Event
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="emailModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Enter an email address to rsvp</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <p class="col-md-offset-2">A confirmation for your booking will be sent to this address.</p>
                    <form id="rsvpForm">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="#email" class="col-md-offset-2 col-md-2 control-label">Email</label>
                            <div class="col-md-6">
                                <input 
                                    id="email" 
                                    v-model="rsvp.email"
                                    type="text" 
                                    class="form-control" 
                                    name="email"  
                                    placeholder="example@email.com" 
                                    required 
                                    autofocus>
                            </div>
                        </div>

                        @if($event->hasSeats())
                            <div class="col-md-offset-2 col-md-8">
                                <event-seats-form 
                                    id="eventSeats" 
                                    :event="event"
                                    v-model="rsvp.preferences.seats"
                                    url="/public/eventos/details/">
                                </event-seats-form>
                            </div>
                        @endif

                        <div class="form-group">
                            <div class="text-right col-md-6 col-md-offset-4">
                                <button 
                                    v-on:click.prevent="onSubmit"
                                    data-dismiss="modal"
                                    type="submit" 
                                    class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection