{{--
Params:
    string $labelSize sets the size for the label column e.g '3'
    string $inputSize sets the size for the input column e.g '6'
--}}

<form class="form-horizontal" method="POST" >
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
        <label for="title-input" class="col-md-{{$labelSize}} control-label">Event Title</label>
        <div class="col-md-{{$inputSize}}">
            <input id="title-input" type="text" class="form-control" name="title-input"  placeholder="My Event" required autofocus>
        </div>
    </div>

    <div class="form-group{{ $errors->has('host-name-input') || $errors->has('host-email-input')? ' has-error' : '' }}">
        <label for="host-name-input" class="col-md-{{$labelSize}} control-label">Host</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="host-checkbox" type="checkbox" aria-label="Set the host">
                </span>
                <input id="host-name-input" type="text" class="form-control" name="host-name-input" placeholder="Host name" disabled="true">
                <input id="host-email-input" type="email" class="form-control" name="host-email-input" placeholder="Host email" disabled="true">
            </div>
        </div>
        <div class="col-md-{{$inputSize}} col-md-offset-{{$labelSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="from-host-checkbox" type="checkbox" class="" name="from-host-checkbox" title="Enabling this option will send invitations addressed from the host (opposed to by you)" disabled="true">
                </span>
                <span class="input-group-addon text-left" style="width: 100%;">Invitations sent from host
                </span>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('description-input') ? ' has-error' : '' }}">
        <label for="description-input" class="col-md-{{$labelSize}} control-label">Description</label>
        <div class="col-md-{{$inputSize}}">
            <textarea id="description-input" type="text" class="form-control" name="description-input" required></textarea>
        </div>
    </div>

    <div class="form-group{{ $errors->has('start-date-time') ? ' has-error' : '' }}">
        <label for="start-date-time" class="col-md-{{$labelSize}} control-label">From</label>
        <div class="col-md-{{$inputSize}}">
            <input id="start-date-time" type="datetime-local" class="form-control" name="start-date-time" required placeholder="Starting at">
        </div>
    </div>

    <div class="form-group{{ $errors->has('end-date-time') ? ' has-error' : '' }}">
        <label for="end-date-time" class="col-md-{{$labelSize}} control-label">To</label>
        <div class="col-md-{{$inputSize}}">
            <input id="end-date-time" type="datetime-local" class="form-control" name="end-date-time" required placeholder="Ending at">
        </div>
    </div>

    @include('guests.subviews.create', ['labelSize' => $labelSize, 'inputSize' => $inputSize])

    <div class="form-group{{ $errors->has('rsvp-datetime-input') ? ' has-error' : '' }}">
        <label for="rsvp-datetime-input" class="col-md-{{$labelSize}} control-label">RSVP</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="rsvp-datetime-checkbox" type="checkbox" aria-label="Enable RSVP">
                </span>
                <input id="rsvp-datetime-input" type="datetime-local" class="form-control" name="rsvp-datetime-input" required placeholder="Ending at" disabled="true">
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('venue-input') ? ' has-error' : '' }}">
        <label for="venue-input" class="col-md-{{$labelSize}} control-label">Venue</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="venue-checkbox" type="checkbox" aria-label="Enable Venue">
                </span>
                <input id="venue-input" list="venues-list" class="form-control" name="venue-input" required placeholder="Select Venue" disabled="true">
                <datalist id="venues-list">
                    <option value="Costi's">
                    <option value="Uluru">
                    <option value="Cat Cafe?">
                    <option value="Home, 21 nowhere st">
                    <option value="UTS, 21 somewhere st Australia">
                </datalist>
                <span data-toggle="modal" data-target="#create-venue-modal" class="input-group-addon">
                    <a href="#">Or Create Venue</a>
                </span>
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('max-guests-input') ? ' has-error' : '' }}">
        <label for="max-guests-input" class="col-md-{{$labelSize}} control-label">Max Guests</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="max-guests-checkbox" type="checkbox" aria-label="Enable Max Guests">
                  </span>
                <input id="max-guests-input" type="number" min="0" class="form-control" name="max-guests-input" required disabled="true">
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('price-input') ? ' has-error' : '' }}">
        <label for="max-guests-input" class="col-md-{{$labelSize}} control-label">Ticket Price</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="price-checkbox" type="checkbox" aria-label="Enable Ticket Price">
                </span>
                <input id="price-input" type="text" min="0" class="form-control" style="outline: none;" name="price-input" placeholder="00.00" disabled="true">
            </div>
        </div>
    </div>

    <div class="form-group{{ $errors->has('seats-input') ? ' has-error' : '' }}">
        <label for="seats-input" class="col-md-{{$labelSize}} control-label">Seat Numbers</label>
        <div class="col-md-{{$inputSize}}">
            <div class="input-group">
                <span class="input-group-addon">
                    <input id="seats-checkbox" type="checkbox" aria-label="Enable Seats">
                </span>
                <select id="seats-input" class="form-control seat-select2" name="seats-input" style="width: 100%" multiple="multiple"></select>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="text-right col-md-{{$inputSize}} col-md-offset-{{$labelSize}}">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>

</form>

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
