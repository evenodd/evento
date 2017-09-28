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
                        <p> Event Time : <b> 20/01/2017 3.30pm to 21/01/2017 1.00am </b></p>
                        <p> Venue : <b> <a href="#">UTS, 21 somewhere st Australia</a></b></p>
                        <p> Ticket Price : <b> ${{ $event->price }} </b></p>
                        <p> Description : <b> just another fun birthday party for myself </b></p>
                        <p> Attending Guests: <b> 5/{{ $event->max_guests }}</b></p>
                        @if(!$event->canceled)
                        <p>Seats Available: 
                            <b>1A, 4A, 3B, 6D, 1E, 4E, 3F, 6F, 1G, 4H, 3I, 6I</b>
                            <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#show-seats-modal">
                                <span class="" name="event-guest-nb">+13  More...</span>
                            </button>
                        </p>
                        <p>Suppliers:
                            <span class="btn-group">
                                <button class="btn btn-default btn-large btn-secondary" data-toggle="modal" data-target="#supplierModal">Jims Catering</button>
                                <button class="btn btn-default btn-large btn-secondary">Add Supplier</button>
                            </span>     
                        </p>                                 
                        <a id="sendInvitationsButton" class="btn btn-lg btn-success center-block">Send Invitations</a>
                        <br>
                        <div id="guestList" class="list-group">
                            @each('guests.subviews.row', array(
                                (object) ['fullName' => 'Arthur Curry'],
                                (object) ['fullName' => 'Barry Allen' ],
                                (object) ['fullName' => 'Diana Prince'],
                                (object) ['fullName' => 'Clark Kent'  ],
                                (object) ['fullName' => 'Bruce Wayne' ]
                            ), 'guest')
                        </div>
                        @endif
                    </ul>
                    @if(!$event->canceled)
		            <div class="text-right">
			            <a class="btn btn-default">Edit</a>
                        <form style="display:inline;" action="/eventos/{{$event->id}}/cancel" method="post">
                            {{ csrf_field() }}
                            <button id="cancelEventButton" type="submit" class="btn btn-danger">Cancel Event</button>
                        </form>
		            </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div id="show-seats-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Event Seats</h4>
            </div>
            <div class="modal-body">
                @include('seats.subviews.show')
            </div>
        </div>
    </div>
</div>

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
                            <span class="col-xs-3 vertical-center text-left">@{{invite.email}}</span>
                            <span class="col-xs-6 text-left vertical-center">
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

@endsection