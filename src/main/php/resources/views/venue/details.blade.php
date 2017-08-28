@extends('layouts.app')

@section('script')
<script src="{{ asset('js/home/home.js') }}"></script>
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
				@include('venue.subviews.details')
				
			</div>
		</div>
	</div>
</div>
@endsection
