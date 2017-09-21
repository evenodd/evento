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
				    <div class="row">
                        <div class="col-xs-2 col-xs-offset-5">
                            <pacman-loader id="list-loader" :loading="loading" :color="color" :size="size"></pacman-loader>
                        </div>
                    </div>
				    <event-list v-bind:events="events" id="event-list"></event-list>
				</div>
            </div>
        </div>
    </div>
</div>
@endsection
