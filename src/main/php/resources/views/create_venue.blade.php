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
                    <b>Create (or update) Venue</b>
                </div>
                <div class="panel-body">
                    <label for="basic-url">Venue Details</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="Venue Name" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="Venue Description" aria-describedby="basic-addon1">
                    </div>
                    <label for="basic-url">Venue Location</label>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"> </span>
                      <input type="text" class="form-control" placeholder="Street Number" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="Address Line 1" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="Address Line 2" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="City" aria-describedby="basic-addon1">
                    </div>
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="State" aria-describedby="basic-addon1">
                    </div>
                   <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="Post Code" aria-describedby="basic-addon1">
                    </div>
                    
                    <div class="input-group">
                      <span class="input-group-addon" id="basic-addon1"></span>
                      <input type="text" class="form-control" placeholder="Number of Guests" aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <a href="#" data-toggle="modal" data-target="#addBookingModal" id="addBooking" class="btn btn-π btn-success center-block">
            Add Venue
        </a>

    </div>
</div>


  </div>
</div>

@endsection
