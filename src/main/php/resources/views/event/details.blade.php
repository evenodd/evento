@extends('layouts.app')
 
@section('script')
<script src="{{ asset('js/evento/details.js') }}"></script>
@endsection

@section('content')

<div id="event-details-container" data-event="{{ $event }}" class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($event->canceled)
                    <b>Canceled Event: <del>{{ $event->title }}</del></b>
                    @else
                    <b>{{ $event->title }}</b>
                    @endif
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        <p> Event Time : <b> {{ $event->start_datetime}} to {{ $event->end_datetime }} </b></p>
                        
                        <!-- Todo -->
                        <!-- Create a generic venue element -->
                        <p id="venue"><span>Venue : </span><venue-display :id="id"></venue-display></p>
                        <!--  -->
                        @if($event->price)
                            <p> Ticket Price : <b> ${{ $event->price }} </b></p>
                        @endif
                        <p> Description : <b> {{ $event->description }} </b></p>
                        <p> Attending Guests:
                            <b> 
                            <span id="guestNumber">
                                @{{guestNb}}
                            </span>
                            @if($event->max_guests)
                                /{{ $event->max_guests }}
                            @endif
                            </b>
                        </p>
                        @can('view', $event)
                            @if(!$event->canceled)
                                <p>Seats Available: <event-seats id="eventSeats" :event="event"></event-seats></p>
                                <p>Suppliers:
                                    <span class="btn-group">
                                        <!-- <button class="btn btn-default btn-large btn-secondary" data-toggle="modal" data-target="#supplierModal">Jims Catering</button> -->
                                        <button class="btn btn-default btn-large btn-secondary">Add Supplier</button>
                                    </span>     
                                </p>                                 
                                <a id="sendInvitationsButton" class="btn btn-lg btn-success center-block">Send Invitations</a>
                                <br>
                                <div id="rsvpList" class="list-group">
                                    <rsvp-list
                                        v-for="rsvp in rsvps"
                                        :key="rsvp.id"
                                        :rsvp="rsvp">
                                    </rsvp-list>
                                </div>
                            @endif
                        @endcan
                    </ul>
                    @can('update', $event)
                        @if(!$event->canceled)
                            <div class="text-right">
        			            <a href="/eventos/edit/{{ $event->id }}" class="btn btn-default">Edit</a>
                                <form style="display:inline;" action="/eventos/{{ $event->id }}/cancel" method="post">
                                    {{ csrf_field() }}
                                    <button id="cancelEventButton" type="submit" class="btn btn-danger">Cancel Event</button>
                                </form>
        		            </div>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>

@can('view', $event)
    @can('update', $event)
        <div id="invitationModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div id="guests-list" class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 v-if="sending">Sending Invites <small>(@{{counter}} more to go)</small></h4>
                        <h4 v-else-if="counter == 0">All invites have been sent :)</h4>
                        <h4 v-else>Confirm sending invitations to these guests?</h4>
                    </div>
                    <div v-if="invites.length > 0" class="modal-body" >
                        <div v-if="errors > '0'" class="alert alert-danger"><strong>Warning @{{errors}} invitation(s) could not be sent. Please try refreching your browser and sending these invites again. If this error persists contact us at help@evento.com</strong></div>
                        <div style="max-height:400px; overflow-y:auto; overflow-x: hidden;">
                            <ol style="list-style:none;">
                                <li v-for="invite in invites" class="row" style="height: 40px;">
                                    <span class="col-xs-8 vertical-center text-left">@{{invite.email}}</span>
                                    <span class="col-xs-3 text-right vertical-center">
                                        <span :id="'sendResults-' + invite.id"></span>
                                        <pulse-loader :loading="invite.loading" :color="'grey'" :size="'5px'">
                                            
                                        </pulse-loader>
                                    </span>
                                </li>
                            </ol>
                        </div>
                        <button v-if="!sending && counter > 0" v-on:click="sendInvitations" class="btn btn-success center-block">Yes send invitations</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="supplierModal" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Supplier Products</h4>
                    </div>
                    <div class="modal-body">
                        @include('suppliers.subviews.details', [
                            'supplier' => (object)[
                                'name' => 'Jims Catering',
                                'products' => array(
                                    (object) [
                                        'name' => '<b>Main Meal: </b> Duck Soup', 
                                        'price' => 30, 
                                        'multiplier' => 5, 
                                        'multiplierType' => 'Guests'
                                    ],
                                    (object) [
                                        'name' => '<b>Buffet: </b> Vegetariann', 
                                        'price' => 900, 
                                        'multiplier' => 1, 
                                        'multiplierType' => 'Event',
                                        'last' => true
                                    ]
                                )
                            ]
                        ])
                    </div>
                </div>
            </div>
        </div>
    @endcan
@endcan
@endsection