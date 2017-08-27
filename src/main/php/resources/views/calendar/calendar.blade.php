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
					<div id='fullYear' style='display: none;' class='row'>
							<div class="col-md-12">
								<div class="btn-toolbar justify-content-center" role="toolbar" aria-label="Toolbar with button groups">
									<div style="width: 100%" class="btn-group">
										<button style="width: 5%;" id="prevYear" class="btn btn-default btn-large btn-secondary"><</button>
										<button style="width: 90%;" id="exitFullYear" class="btn btn-default btn-large btn-secondary">Exit Year View</button>
										<button style="width: 5%;" id="nextYear" class="btn btn-default btn-large btn-secondary">></button>
									</div>
								</div>
							</div>
							@for ($i = 1; $i <= 12; $i++)
								<div class= 'col-md-6'>
									<div id='calendar-{{$i}}'></div>
								</div>
							@endfor
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

