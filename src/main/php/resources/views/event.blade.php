@extends('layouts.app')

@section('script')
<script src="{{ asset('js/event/details.js') }}"></script>
@endsection

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>{{event->title}}</b>
                </div>
                <div class="panel-body">
                    <div id = ""></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="col-md-8 col-md-offset-2">
        <a href="#" data-toggle="modal" data-target="#addBookingModal" id="addBooking" class="btn btn-lg btn-success center-block">
            Add Event
        </a>
    </div>
</div>

<div id="addBookingModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Event</h4>
      </div>
      
      <div class="modal-body">
        </br>
        </br>
        </br>
        </br>
        <p>Add the form here :P</p>
        </br>
        </br>
        </br>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default">Submit</button>
      </div>
    </div>

  </div>
</div>

@endsection
