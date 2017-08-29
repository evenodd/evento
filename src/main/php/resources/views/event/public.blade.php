@extends('layouts.app')

@section('script')
<script src="{{ asset('js/home/home.js') }}"></script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">        
                <div class="panel-heading"><b>Public Events</b></div>
				@include('event.subviews.list', ['events' => array(
		            (object)[
		                'title' => 'Birthday Party at UTS',
		                'start_time' => '28th Sep 04:00 am',
		                'guestsNb' => sprintf('%02d', rand(0,99))
		            ],
		            (object)[
		                'title' => 'Post Assignment Party',
		                'start_time' => '30th Aug 08:55 am',
		                'guestsNb' => sprintf('%02d', rand(0,99))
		            ],
		            (object)[
		                'title' => 'Music Festival',
		                'start_time' => '20th Apr 03:00 pm',
		                'guestsNb' => sprintf('%02d', rand(0,99))
		            ],
		            (object)[
		                'title' => 'Primary School Funday',
		                'start_time' => '10th May 03:00 pm',
		                'guestsNb' => sprintf('%02d', rand(0,99))
		            ],
		            (object)[
		                'title' => 'Wedding at Stephanoes',
		                'start_time' => '02nd Nov 12:00 pm',
		                'guestsNb' => sprintf('%02d', rand(0,99)),
		                'last' => true
		            ],
		        )])
	        </div>
        </div>
    </div>
</div>


@endsection
