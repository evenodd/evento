@extends('layouts.app')

@section('script')
<script src="{{ asset('js/evento/public.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">        
                <div class="panel-heading"><b>Public Events</b></div>
                <div class="panel-body">
                    <event-list 
                    	id="publicEventList"
                        url="/eventos/public"
                        error_message="Error could could not get data from server"
        				:show_guests="false"
                        redirect="/public/eventos/details/">
                	</event-list>
                </div>
	        </div>
        </div>
    </div>
</div>
@endsection
