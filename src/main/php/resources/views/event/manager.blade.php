@extends('layouts.app')

@section('script')
<script src="{{ asset('js/evento/manager.js') }}"></script>
@endsection

@section('content')

@include('event.subviews.manager')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">        
                <div class="panel-heading"><b>My Events</b></div>
				@include('event.subviews.list')
            </div>
        </div>
    </div>
</div>

@endsection
