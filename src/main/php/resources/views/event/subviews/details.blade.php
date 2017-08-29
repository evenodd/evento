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
                      <p> Venue : <b> <a href="#">UTS, 21 somewhere st Australia</a></b></p>
                      <p> Ticket Price : <b> $30.00 </b></p>
                      <p> Description : <b> just another fun birthday party for myself </b></p>
                      <p> Attending Guests: <b> 5/30</b></p>
                      <p>Seats Available: 
                        <b>1A, 4A, 3B, 6D, 1E, 4E, 3F, 6F, 1G, 4H, 3I, 6I</b>
                        <button class="btn btn-xs btn-default" data-toggle="modal" data-target="#show-seats-modal"><span class="" name="event-guest-nb">+13  More...</span></button>
                      </p>
                      <p>Suppliers:
                          <span class="btn-group">
                              <button class="btn btn-default btn-large btn-secondary" data-toggle="modal" data-target="#supplierModal">Jims Catering</button>
                              <button class="btn btn-default btn-large btn-secondary">Add Supplier</button>
                          </span>     
                      </p>                                 
                      <a href="#" class="btn btn-lg btn-success center-block">
                          Send Invitations
                      </a>
                      <br>
                      <div id="#guestList" class="list-group">
                        @each('guests.subviews.row', array(
                          (object) ['fullName' => 'Arthur Curry'],
                          (object) ['fullName' => 'Barry Allen' ],
                          (object) ['fullName' => 'Diana Prince'],
                          (object) ['fullName' => 'Clark Kent'  ],
                          (object) ['fullName' => 'Bruce Wayne' ]
                        ), 'guest')
                      </div>
                    </ul>
                </div>

            </div>
            <button type="button" class="btn btn-danger">Delete Event</button>
        </div>

    </div>
    
</div>

<div class="container">
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

<div id="supplierModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Supplier Products</h4>
      </div>
      <div class="modal-body">
        @include('suppliers.subviews.details', [
              'supplier' => (object)[
                  'name' => 'Jims Catering',
                  'products' => array(
                      (object) [
                          'name' => '<b>Main Meal: </b> Duck Soup', 
                          'price' => 30, 
                          'multiplier' => 5, 
                          'multiplierType' => 'Guests'
                      ],
                      (object) [
                          'name' => '<b>Buffet: </b> Vegitarian', 
                          'price' => 900, 
                          'multiplier' => 1, 
                          'multiplierType' => 'Event',
                          'last' => true
                      ]
                  )
              ]
          ])
      </div>
    </div>
  </div>

</div>
