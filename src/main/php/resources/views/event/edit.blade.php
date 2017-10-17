@extends('layouts.app')

@section('script')

<script src="{{ asset('js/evento/edit.js') }}"></script>
@endsection

@section('content')
    <div id="eventData" data-event="{{ $event }}" class="container">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @component('components.alerts')
                @endcomponent
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Update Event</b>
                    </div>
                    <div class="panel-body">
    					
    					<event-form
                            id="eventForm"
                            :event="event"
                            v-on:failed="showError">
                        </event-form>

    				</div>
                </div>
            </div>
        </div>
    </div>
@endsection
