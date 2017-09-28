{{--
	Params:
	Venue $venue
 --}}

@extends('layouts.app')

@section('script')
<script src="{{ asset('js/venue/detailVenue.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
        	<p>
	        	<button class="btn btn-primary">
	        		Create New Venue
	        	</button>
        	</p>
            <div class="panel panel-default">
				<div class="panel-heading">
				    <b>{{ $venue->name }}</b>
				</div>
				<div class="panel-body">
				    <ul class="nav nav-pills nav-stacked">
			        <li> Address : <b> {{ $venue->address }} </b></li>
				        <li> Contacts :
				            <ul>
				                @foreach(json_decode($venue->contact, true) as $key => $c)
				                    <li>{{ $key }}: <b> {{ $c }} </b></li>
				                @endforeach
				            </ul>
				        </li>
				        <li> max Capacity : <b> {{ $venue->capacity }} people </b></li>
				    </ul>
				</div>
				<div class="panel-footer text-right">
				    <button class="btn btn-success">Edit</button>
					<button class="btn btn-warning">Disable this Venue</button>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
			        <h4><b> Events using this venue: </b></h4>
		        </div> 
				<div class="panel-body">
			        <event-list 
	                    id="eventList"
	                    url="/venue/details/{{$venue->id}}/events"
	                    error_message="Error could could not get data from server"
	                    show_guests="true">
	                </event-list>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
