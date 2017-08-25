@extends('layouts.app')

@section('script')
<script src="{{ asset('js/home/home.js') }}"></script>
@endsection

@section('content')

@include('event.subviews.list')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Event Manager View</b>
                </div>
                <div class="panel-body">
                   <ul class="nav nav-pills nav-stacked">
                      <li role="presentation"><a href="#"> Create A New Event </a></li>
                      <li role="presentation"><a href="#"> Invite A Guest </a></li>
                      <li role="presentation"><a href="#"> Add A Supplier To My Event </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

  </div>
</div>

@endsection
