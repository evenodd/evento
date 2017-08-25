<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Create (or update) Venue</b>
                </div>
                <div class="panel-body">
                <!-- TODO: form errors -->
                    <form class="form-horizontal" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title-input" class="col-md-4 control-label">Venue Name</label>
                            <div class="col-md-6">
                                <input id="title-input" type="text" class="form-control" name="title-input"  placeholder="New Venue Name" required autofocus>
                            </div>
                        </div>

                        <div class="form-group ">
                            <label for="description-input" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea id="description-input" type="text" class="form-control" name="description-input" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="address-input" class="col-md-4 control-label">Address</label>
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
                                <input id="city-input" type="text" class="form-control" name="city-input" required placeholder="City">
                            </div>
                            <div class="col-md-3">
                                <input id="state-input" type="text" class="form-control" name="state-input" required placeholder="State">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label"></label>
                            <div class="col-md-2">
                                <input id="postcode-input" type="text" class="form-control" name="postcode-number" required placeholder="Postcode">
                            </div>
                            <div class="col-md-4">
                                <input id="country-input" type="text" class="form-control" name="country-number" required placeholder="Country">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="max-capacity-input" class="col-md-4 control-label">Max Capacity</label>
                            <div class="col-md-6">
                                <input id="max-capacity-input" type="number" class="form-control" name="max-capacity-input" required>
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
                </div>
            </div>
        </div>
    </div>
</div>
