@extends('layouts.app')

@section('script')
<script src="{{ asset('js/evento/manager.js') }}"></script>
<script src="{{ asset('js/evento/create.js') }}"></script>
<script src="{{ asset('js/evento/list.js') }}"></script>
<script src="{{ asset('js/venue/createVenue.js') }}"></script>
<script src="{{ asset('js/calendar/calendar.js') }}"></script>

@endsection
@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 ">
            
            <div class="panel panel-default">        
                <div class="panel-heading"><b>My Events</b></div>
                <div class="panel-body">
                    <event-list 
                        id="eventList"
                        url="/eventos"
                        error_message="Error could could not get data from server"
                        show_guests="true">
                    </event-list>
                </div>
            </div>

            <div class="panel panel-default">        
                <div class="panel-heading"><b>My Venues</b></div>
                <div class="panel-body">
                    <venue-list 
                        id="venueList"
                        url="/venues"
                        error_message="Error could could not get data from server">
                    </venue-list>
                </div>
            </div>

        </div>
        <div class="col-md-4">

            @include('event.subviews.manager')

            <div class="panel panel-default">
                <div class="panel-body">
                    <div id='calendar'></div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
