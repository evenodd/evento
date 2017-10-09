@extends('layouts.app')

@section('script')
<script src="{{ asset('js/evento/list.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">        
                <div class="panel-heading"><b>My Events</b></div>
				<div class="panel-body">
				    <event-list 
                        id="eventList"
                        url="/eventos"
                        error_message="Error could could not get data from server"
                        :show_guests="true"
                        redirect="/eventos/details/">
                    </event-list>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
