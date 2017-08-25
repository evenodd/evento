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
                   
                   <form class="form-horizontal" method="POST" >

                        {{ csrf_field() }}

                      <p> I, <b>Shayne</b> would like to RSVP to the event <b> Wedding at Stephanos </b> </p>
                      <div class="form-group ">
                        <label for="dietary-input" class="col-md-4 control-label">Dietary Requirements</label>
                          <div class="col-md-6">
                            <textarea id="dietary-input" type="text" class="form-control" name="dietary-input" required></textarea>
                          </div>
                      </div>
                    </form>
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
