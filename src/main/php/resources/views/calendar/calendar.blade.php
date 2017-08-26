@extends('layouts.app')

@section('script')
<script src="{{ asset('js/calendar/calendar.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
					<div id='calendar'></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

