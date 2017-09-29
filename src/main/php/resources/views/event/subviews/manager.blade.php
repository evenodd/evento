
<div class="panel panel-default">
    <div class="panel-heading">
        <b>Manager Panel</b>
    </div>
    <div class="panel-body">
       <ul class="nav nav-pills nav-stacked">
            @can('create', App\Evento::class)
                <li role="presentation">
                    <a href="#" data-toggle="modal" data-target="#create-event-modal"> Create A New Event </a>
                </li>
            @endcan
            @can('create', App\Venue::class)
                <li role="presentation">
                    <a href="#" data-toggle="modal" data-target="#create-venue-modal"> Create A New Venue </a>
                </li>
            @endcan
            <li role="presentation">
                <a href="#" data-toggle="modal" data-target="#add-guests-modal">Invite More Guests To An Event</a>
            </li>
            <li role="presentation">
                <a href="#"> Add A Supplier To My Event </a>
            </li>
        </ul>
    </div>
</div>

@can('create', App\Venue::class)
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
@endcan

@can('create', App\Evento::class)
<div id="create-event-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create Event</h4>
      </div>
        <div class="modal-body">
          @include('event.subviews.create', ['labelSize' => '3', 'inputSize' => '9', 'showCreateVenue' => false])
        </div>
    </div>
  </div>
</div>
@endcan

<div id="add-guests-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Guests</h4>
      </div>
      <form>
        <div class="modal-body row">
          <div class="form-group{{ $errors->has('evento-input') ? ' has-error' : '' }}">
            <label for="evento-input" class="col-md-3 control-label">Event</label>
            <div class="col-md-9">
                <select id="evento-input" min="0" class="evento-select2 form-control" style="width: 100%" name="evento-input" placeholder="Select an event"></select>
            </div>
          </div>

          @include('guests.subviews.create', ['labelSize' => '3', 'inputSize' => '9'])

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>