{{--
	Params:
	Venue $venue
 --}}

@extends('layouts.app')

@section('script')
<script src="{{ asset('js/venue/detailVenue.js') }}"></script>
@endsection

@section('content')
<div id="venue-details" data-venue="{{ $venue }}" class="container">
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
	        @component('components.alerts')
	        @endcomponent
            <div class="panel panel-default">
				<div class="panel-heading">
					@if($venue->enabled)
					    <b>{{ $venue->name }}</b>
				    @else
				    	<b>Canceled Venue: <del>{{$venue->name}}</del></b>
				    @endif
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
				@can('update', $venue)
					@if($venue->enabled)
						<div class="panel-footer text-right">
						    <a href="/venue/edit/{{ $venue->id }}" class="btn btn-success">Edit</a><span>
						    <form 
						    	id="cancelVenue"  
						    	method="POST" 
						    	action="/venues/cancel/{{$venue->id}}"
						    	style=" display:inline!important;">
								<button id="cancelVenueButton" class="btn btn-warning" type="submit">Disable this Venue</button>
							</form></span>
						</div>
					@endif
				@endcan
			</div>
			@can('update', $venue)
				@if($venue->enabled)
					<div class="panel panel-default">
						<div class="panel-heading">
					        <h4><b> Events using this venue: </b></h4>
				        </div> 
						<div class="panel-body">
					        <event-list 
			                    id="eventList"
			                    url="/venue/details/{{$venue->id}}/events"
			                    error_message="Error could could not get data from server"
			                    :show_guests="true"
			                    redirect="/venues/{{$venue->id}}/events/details/">
			                </event-list>
						</div>
					</div>
				@endif
			@endcan
		</div>
	</div>
</div>
@endsection