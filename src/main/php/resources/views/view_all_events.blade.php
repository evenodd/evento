@extends('layouts.app')

@section('script')
<script src="{{ asset('js/home/home.js') }}"></script>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>View All My Events</b>
                </div>
                <div class="panel-body">
                   <ul class="nav nav-pills nav-stacked">
                      <li role="presentation">28/04/2017 4.00<a href="#"> Birthday Party at UTS </a> </li>
                      <li role="presentation">29/05/2017 4.00<a href="#"> Serious Business Meetup 203 </a>  </li>
                      <li role="presentation">30/06/2017 4.00<a href="#"> Wedding at Stephanos </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

  </div>
</div>

@endsection
