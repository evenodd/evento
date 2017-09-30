@extends('layouts.app')

@section('script')
<script src="{{ asset('js/venue/createVenue.js') }}"></script>
@endsection

<!-- small change -->

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @component('components.alerts')
                @endcomponent
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <b>Create (or update) Venue</b>
                    </div>
                    <div class="panel-body">
    					@include('venue.subviews.create')
    				</div>
                </div>
            </div>
        </div>
    </div>
@endsection
