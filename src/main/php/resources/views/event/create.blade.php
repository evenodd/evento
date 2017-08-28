@extends('layouts.app')

@section('script')

<script src="{{ asset('js/evento/create.js') }}"></script>

@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Create (or update) Event</b>
                </div>
                <div class="panel-body">
					
					@include('event.subviews.create', ['labelSize' => '4', 'inputSize' => '6'])

				</div>
            </div>
        </div>
    </div>
</div>

@endsection
