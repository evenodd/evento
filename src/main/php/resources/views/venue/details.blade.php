@extends('layouts.app')

@section('script')
<script src="{{ asset('js/home/home.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
				@include('venue.subviews.details')
				<div class="panel-footer text-right">
					<button class="btn btn-warning">Disable this Venue</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
