<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <b>Birthday Party at UTS</b>
                </div>
                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                      <p> Event Time : <b> 20/01/2017 3.30pm to 21/01/2017 1.00am </b></p>
                      <p> Venue : <b> UTS, 21 somewhere st Australia</b></p>
                      <p> Ticket Price : <b> $30.00 </b></p>
                      <p> Description : <b> just another fun birthday party for myself </b></p>
                      <p> Attending Guests: <b> 5/30</b></p>
                      <p>Seats Available: 
                        <b>1A, 4A, 3B, 6D, 1E, 4E, 3F, 6F, 1G, 4H, 3I, 6I</b>
                        <btn class="btn btn-xs btn-default" data-toggle="modal" data-target="#show-seats-modal"><span class="" name="event-guest-nb">+13  More...</span></a>
                      </p>
                      <div class="list-group">
                        <span class="list-group-item">
                          <div class="row">
                            <span class="col-xs-5">Arthur Curry</span>
                            <a class="col-xs-7 text-right">Click Here for Dietary Requirements</a>
                          </div>
                        </span>
                        <span class="list-group-item">
                          <div class="row">
                            <span class="col-xs-5">Barry Allen</span>
                            <a class="col-xs-7 text-right">Click Here for Dietary Requirements</a>
                          </div>
                        </span>
                        <span class="list-group-item">
                          <div class="row">
                            <span class="col-xs-5">Diana Prince</span>
                            <a class="col-xs-7 text-right">Click Here for Dietary Requirements</a>
                          </div>
                        </span>
                        <span class="list-group-item">
                          <div class="row">
                            <span class="col-xs-5">Clark Kent</span>
                            <a class="col-xs-7 text-right">Click Here for Dietary Requirements</a>
                          </div>
                        </span>
                        <span class="list-group-item">
                          <div class="row">
                            <span class="col-xs-5">Bruce Wayne</span>
                            <a class="col-xs-7 text-right">Click Here for Dietary Requirements</a>
                          </div>
                        </span>
                      </div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="show-seats-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Event Seats</h4>
      </div>
      <div class="modal-body">
        @include('seats.subviews.show')
      </div>
    </div>
  </div>
</div>
