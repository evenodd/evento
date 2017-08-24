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
                    <b>RSVP</b>
                </div>
                <div class="panel-body">
                   <p> I, <b>Shayne</b> would like to RSVP to the event <b> Wedding at Stephanoes </b> </p>

                   <label for="basic-url">Diatary Requirements</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <a href="#" data-toggle="modal" data-target="#addBookingModal" id="addBooking" class="btn btn-π btn-success center-block">
            RSVP to Event
        </a>

    </div>
</div>


  </div>
</div>

@endsection
