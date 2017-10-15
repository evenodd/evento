
@extends('layouts.app')

@section('script')
<script src="{{ asset('js/venue/venueList.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">        
                <div class="panel-heading"><b>Venue list</b></div>
				<div class="panel-body">
				    <venue-list 
                        id="venueList"
                        url="/venues/"
                        :venues="venues"
                        error_message="Error could could not get data from server"
                        :show_guests="true">
                    </venue-list>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection