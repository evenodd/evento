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
                    <b>Create (or update) Event</b>
                </div>
                <div class="panel-body">
                    <label for="basic-url">Start Date and End Date</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"> </span>
                      <input type="text" class="form-control" placeholder="Start Date" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="End Date" aria-describedby="basic-addon1">
                    </div>
                     <label for="basic-url">Venue</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="Select Venue" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="Number of Guests" aria-describedby="basic-addon1">
                    </div>
                     <label for="basic-url">Ticket Price</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="Price" aria-describedby="basic-addon1">
                    </div>
                     <label for="basic-url">Description</label>
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
            Add Event
        </a>

    </div>
</div>


  </div>
</div>

@endsection
