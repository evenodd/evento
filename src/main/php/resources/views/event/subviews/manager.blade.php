

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