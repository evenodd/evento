{{--
Params:
    string $labelSize sets the size for the label column e.g '3'
    string $inputSize sets the size for the input column e.g '6'
--}}
<div >
<form id="createEventForm" class="form-horizontal" method="POST" action="/eventos">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title" class="col-md-{{$labelSize}} control-label">Event Title</label>
        <div class="col-md-{{$inputSize}}">
            <input id="title" type="text" class="form-control" name="title"  placeholder="My Event" required autofocus>
        </div>
    </div>


    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
        <label for="description" class="col-md-{{$labelSize}} control-label">Description</label>
        <div class="col-md-{{$inputSize}}">
            <textarea id="description" type="text" class="form-control" name="description"></textarea>
        </div>
    </div>

    <div class="form-group{{ $errors->has('start-datetime') ? ' has-error' : '' }}">
        <label for="start-datetime" class="col-md-{{$labelSize}} control-label">From</label>
        <div class="col-md-{{$inputSize}}">
            <input id="start-datetime" type="datetime-local" class="form-control" name="start-datetime" required placeholder="Starting at">
        </div>
    </div>
    @if ($errors->has('start-datetime'))
        <span class="help-block">
            <strong>{{ $errors->first('start-datetime') }}</strong>
        </span>
    @endif


    <div class="form-group{{ $errors->has('end-datetime') ? ' has-error' : '' }}">
        <label for="end-datetime" class="col-md-{{$labelSize}} control-label">To</label>
        <div class="col-md-{{$inputSize}}">
            <input id="end-datetime" type="datetime-local" class="form-control" name="end-datetime" required placeholder="Ending at">
        </div>
    </div>
    @if ($errors->has('end-datetime'))
        <span class="help-block">
            <strong>{{ $errors->first('end-datetime') }}</strong>
        </span>
    @endif

    <div class="form-group{{ $errors->has('venue') ? ' has-error' : '' }}">
        <label for="venue" class="col-md-{{$labelSize}} control-label">Venue</label>
        <div class="col-md-{{$inputSize}}">
            @if($showCreateVenue)<div class="input-group">@endif
                <select id="venue" class="form-control" name="venue" required placeholder="Select Venue">
                    <option val=""></option>
                </select>
                @if($showCreateVenue)
                <span 
                    data-toggle="modal" 
                    data-target="#create-venue-modal" 
                    class="input-group-addon">
                        <a href="#" >Or Create Venue</a>
                    </span>
            </div>@endif
        </div>
    </div>

    @include('guests.subviews.create', ['labelSize' => $labelSize, 'inputSize' => $inputSize])
    <div class="form-group{{ $errors->has('host-name') || $errors->has('host-email')? ' has-error' : '' }}">
        <label for="host-name" class="col-md-{{$labelSize}} control-label">Host</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="host-checkbox" type="checkbox" aria-label="Set the host">
                </span>
                <input id="host-name" type="text" class="form-control" name="host-name" placeholder="Host name" disabled="true">
                <input id="host-email" type="email" class="form-control" name="host-email" placeholder="Host email" disabled="true">
            </div>
        </div>
        <div class="col-md-{{$inputSize}} col-md-offset-{{$labelSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="from-host-checkbox" type="checkbox" class="" name="from-host-checkbox" title="Enabling this option will send invitations addressed from the host (opposed to by you)" disabled="true">
                </span>
                <span class="input-group-addon text-left" style="width: 100%;">
                    Invitations sent from host
                </span>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('rsvp-datetime') ? ' has-error' : '' }}">
        <label for="rsvp-datetime" class="col-md-{{$labelSize}} control-label">RSVP</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="rsvp-datetime-checkbox" type="checkbox" aria-label="Enable RSVP">
                </span>
                <input id="rsvp-datetime" type="datetime-local" class="form-control" name="rsvp-datetime" required placeholder="Ending at" disabled="true">
            </div>
        </div>
    </div>


    <div class="form-group{{ $errors->has('max-guests') ? ' has-error' : '' }}">
        <label for="max-guests" class="col-md-{{$labelSize}} control-label">Max Guests</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="max-guests-checkbox" type="checkbox" aria-label="Enable Max Guests">
                  </span>
                <input id="max-guests" type="number" min="1" class="form-control" name="max-guests" required disabled="true">
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
        <label for="price" class="col-md-{{$labelSize}} control-label">Ticket Price</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="price-checkbox" type="checkbox" aria-label="Enable Ticket Price">
                </span>
                <input id="price" type="text" min="0" class="form-control" style="outline: none;" name="price" placeholder="00.00" disabled="true">
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('seats') ? ' has-error' : '' }}">
        <label for="seats" class="col-md-{{$labelSize}} control-label">Seat Numbers</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="seats-checkbox" type="checkbox" aria-label="Enable Seats">
                </span>
                <select id="seats" class="form-control seat-select2" name="seats" style="width: 100%" multiple="multiple"></select>
                <span class="input-group-btn">  
                    <button class ="btn btn-secondary" id="auto_pop_button" disabled="true">Auto populate</button> 
                </span>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('suppliers') ? ' has-error' : '' }}">
        <label for="suppliers" class="col-md-{{$labelSize}} control-label">Suppliers</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <select id="suppliers" class="form-control seat-select2" placeholder="Select Supplier" name="suppliers" style="width: 100%" multiple="multiple"></select>
                <span class="input-group-addon"> 
                    <a target="_blank" href="/supplier">Or Submit new Supplier</a>
                </span>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label class="text-right col-md-{{$inputSize}} col-md-offset-{{$labelSize}}" for="public-private">Private
        <input id="private" type="radio" value="private" name="public-private" checked="checked"></label>
        <label class="text-right col-md-{{$inputSize}} col-md-offset-{{$labelSize}}" for="public-private">Public
        <input id="public" type="radio" value="public" name="public-private"></label>
    </div>

    <div class="form-group">
        <div class="text-right col-md-{{$inputSize}} col-md-offset-{{$labelSize}}">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>

</form>
</div>
@if($showCreateVenue)
    <div id="create-venue-modal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Create Venue</h4>
                </div>
                <div class="modal-body">
                    @include('venue.subviews.create')
                </div>
            </div>
        </div>
    </div>
@endif
