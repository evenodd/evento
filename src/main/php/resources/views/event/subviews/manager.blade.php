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
                      <li role="presentation"><a href="#" data-toggle="modal" data-target="#add-guests-modal">Invite More Guests To An Event</a></li>
                      <li role="presentation"><a href="#"> Add A Supplier To My Event </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

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
            <label for="evento-input" class="col-md-4 control-label">Event</label>
            <div class="col-md-6">
                <select id="evento-input" min="0" class="evento-select2 form-control" style="width: 100%" name="evento-input" placeholder="Select an event"></select>
            </div>
          </div>

          @include('guests.subviews.create')

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
