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
                    <div id="publicEventErrorMsg" class="center-block">
	                    <p v-if="display">@{{ message }}</p> 
                    </div>
                    <div class="row">
                        <div class="col-xs-2 col-xs-offset-5">
                            <pacman-loader id="publicEventLoader" :loading="loading" :color="color" :size="size"></pacman-loader>
                        </div>
                    </div>
                    <event-list v-bind:events="events" id="publicEventList"></event-list>
                </div>
	        </div>
        </div>
    </div>
</div>
@endsection
