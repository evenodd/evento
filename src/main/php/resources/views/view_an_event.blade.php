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
                    <b>Birthday Party at UTS</b>
                </div>
                <div class="panel-body">
                   <ul class="nav nav-pills nav-stacked">
                      <p> Event Time : <b> 20/01/2017 3.30pm to 21/01/2017 1.00am </b></p>
                      <p> Venue : <b> UTS, 21 somewhere st Australia</b></p>
                      <p> Ticket Price : <b> $30.00 </b></p>
                      <p> Description : <b> just another fun birthday party for myself </b></p>
                      <p> Attending Guests 5/30: </p>
                      <ul class="list-group">
                        <li class="list-group-item">Arthur Curry<a> Click Here for Dietary Requirements </a></li>
                        <li class="list-group-item">Barry Allen<a> Click Here for Dietary Requirements </a></li>
                        <li class="list-group-item">Diana Prince<a> Click Here for Dietary Requirements </a></li>
                        <li class="list-group-item">Clark Kent<a> Click Here for Dietary Requirements </a></li>
                        <li class="list-group-item">Bruce Wayne<a> Click Here for Dietary Requirements </a></li>
                      </ul>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

  </div>
</div>

@endsection
