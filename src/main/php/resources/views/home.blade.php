@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Your Events</b>
                </div>

                <div class="panel-body bookingList">
                    Loading Events...</div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/home/home.js') }}"></script>

@endsection
