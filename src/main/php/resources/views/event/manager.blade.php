@extends('layouts.app')

@section('script')
<script src="{{ asset('js/evento/manager.js') }}"></script>
<script src="{{ asset('js/evento/create.js') }}"></script>
<script src="{{ asset('js/venue/createVenue.js') }}"></script>
@endsection

@section('main-content')            
    @if(in_array(Auth::user()->type, ['event_planner','host']))
        <div class="panel panel-default">
            <div class="panel-heading"><b>My Events</b></div>
            <div class="panel-body">
                <event-list 
                    id="eventList"
                    url="/eventos"
                    error_message="Error could could not get data from server"
                    :show_guests="true"
                    v-model="events"
                    redirect="/eventos/details/">
                </event-list>
            </div>
        </div>
    @endif
    <div class="panel panel-default">        
        <div class="panel-heading"><b>My Venues</b></div>
        <div class="panel-body">
            <venue-list 
                id="venueList"
                url="/venues"
                error_message="Error could could not get data from server"
                v-model="venues">
            </venue-list>
        </div>
    </div>

@endsection

@section('sub-content')
    
    @component('components.notifications')
    @endcomponent

    
    <div class="panel panel-default">
        <div class="panel-heading">
            <b>Manager Panel</b>
        </div>
        <div class="panel-body">
           <ul class="nav nav-pills nav-stacked">
                @can('create', App\Evento::class)
                    <li role="presentation">
                        <a href="#" data-toggle="modal" data-target="#create-event-modal"> Create A New Event </a>
                    </li>
                @endcan
                @can('create', App\Venue::class)
                    <li role="presentation">
                        <a href="#" data-toggle="modal" data-target="#create-venue-modal"> Create A New Venue </a>
                    </li>
                @endcan
                <!-- <li role="presentation">
                    <a href="#" data-toggle="modal" data-target="#add-guests-modal">Invite More Guests To An Event</a>
                </li> -->
                <li role="presentation">
                    <a href="#" disabled> Add A Supplier To My Event (Coming soon)</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div id='calendar'>
                <calendar
                    :events="events"
                    url="/eventos/details/"
                    lang="en">
                </calendar>
            </div>
        </div>
    </div>
@endsection

@section('modals')
    @can('create', App\Venue::class)
    <div id="create-venue-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Venue</h4>
                </div>
                <div class="modal-body">
                    @include('venue.subviews.create')
                </div>
            </div>
        </div>
    </div>
    @endcan

    @can('create', App\Evento::class)
    <div id="create-event-modal" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Create Event</h4>
          </div>
            <div class="modal-body">
              @include('event.subviews.create', ['labelSize' => '3', 'inputSize' => '9', 'showCreateVenue' => false])
            </div>
        </div>
      </div>
    </div>
    @endcan
@endsection

