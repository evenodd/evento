<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Create (or update) Event</b>
                </div>
                <div class="panel-body">

                    <form class="form-horizontal" method="POST" >
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title-input" class="col-md-4 control-label">Event Title</label>
                            <div class="col-md-6">
                                <input id="title-input" type="text" class="form-control" name="title-input"  placeholder="My Event" required autofocus>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('max-guests-input') ? ' has-error' : '' }}">
                            <label for="description-input" class="col-md-4 control-label">Description</label>
                            <div class="col-md-6">
                                <textarea id="description-input" type="text" class="form-control" name="description-input" required></textarea>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('start-date-time') ? ' has-error' : '' }}">
                            <label for="start-date-time" class="col-md-4 control-label">From</label>
                            <div class="col-md-6">
                                <input id="start-date-time" type="datetime-local" class="form-control" name="start-date-time" required placeholder="Starting at">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('end-date-time') ? ' has-error' : '' }}">
                            <label for="end-date-time" class="col-md-4 control-label">To</label>
                            <div class="col-md-6">
                                <input id="end-date-time" type="datetime-local" class="form-control" name="end-date-time" required placeholder="Ending at">
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('venue-input') ? ' has-error' : '' }}">
                            <label for="venue-input" class="col-md-4 control-label">Venue</label>
                            <div class="col-md-6">
                                <input id="venue-input" list="venues-list" class="form-control" name="venue-input" required placeholder="Venue">
                                <datalist id="venues-list">
                                    <option value="Costi's">
                                    <option value="Uluru">
                                    <option value="Cat Cafe?">

                                    <option value="Home, 21 nowhere st">
                                    <option value="UTS, 21 somewhere st Australia">
                                </datalist>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('max-guests-input') ? ' has-error' : '' }}">
                            <label for="max-guests-input" class="col-md-4 control-label">Max Guests</label>
                            <div class="col-md-6">
                                <input id="max-guests-input" type="number" min="0" class="form-control" name="max-guests-input" required>
                            </div>
                        </div>

                        @include('guests.subviews.create')

                        <div class="form-group{{ $errors->has('price-input') ? ' has-error' : '' }}">
                            <label for="max-guests-input" class="col-md-4 control-label">Ticket Price</label>
                            <div class="col-md-6">
                                <input id="price-input" type="text" min="0" class="form-control" style="outline: none;" name="price-input" placeholder="00.00">
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
