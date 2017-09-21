<!-- <form id="createVenueForm" class="form-horizontal" method="POST" action="/eventos"> -->

<form id="createVenueForm" class="form-horizontal" method="POST" action="/createVenue">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('venueName') ? ' has-error' : '' }}">
        <label for="venueName" class="col-md-4 control-label">Venue Name</label>
        <div class="col-md-6">
            <input id="venueName" type="text" class="form-control" name="venueName"  placeholder="New Venue Name" required autofocus>
        </div>
    </div>

    <div class="form-group ">
        <label for="description" class="col-md-4 control-label">Description</label>
        <div class="col-md-6">
            <textarea id="description" type="text" class="form-control" name="description"></textarea>
        </div>
    </div>

    <div class="form-group">
        <label for="address-number" class="col-md-4 control-label">Address</label>
        <div class="col-md-2">
            <input id="address-number" type="int" class="form-control" name="address-number" required placeholder="#">
        </div>
        <div class="col-md-4">
            <input id="street-name" type="text" class="form-control" name="street-name" required placeholder="Street Name">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-3">
            <input id="city" type="text" class="form-control" name="city" required placeholder="City">
        </div>
        <div class="col-md-3">
            <input id="state" type="text" class="form-control" name="state" required placeholder="State">
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label"></label>
        <div class="col-md-2">
            <input id="postcode" type="text" class="form-control" name="postcode" required placeholder="Postcode">
        </div>
        <div class="col-md-4">
            <input id="country" type="text" class="form-control" name="country" required placeholder="Country">
        </div>
    </div>

    <div class="form-group">
        <label for="max-capacity" class="col-md-4 control-label">Max Capacity</label>
        <div class="col-md-6">
            <input id="max-capacity" type="number" class="form-control" name="max-capacity" required>
        </div>
    </div>

    <div class="form-group">
        <div class="text-right col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Submit
            </button>
        </div>
    </div>
</form>
