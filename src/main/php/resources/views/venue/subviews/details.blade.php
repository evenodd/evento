<div class="panel-heading">
    <b>HOYTS Broadway</b>
</div>
<div class="panel-body">
    <ul class="nav nav-pills nav-stacked">
      <p>That cool place in that cool building that shows cool movies?</p>
      <p> Address : <b> Broadway Shopping Centre, Level 2, Cnr Greek & Bay St, Broadway NSW 2007 </b></p>
      <p> Contact : <b> (02) 9003 3820</b></p>
      <p> max Capacity : <b> 5 people </b></p>
    </ul>
    <ul class="nav nav-pills nav-stacked">
    <hr>
    <p><b> Future Events </b></p> 
    <ul class="nav nav-pills nav-stacked">                 
      @each(
        'event.subviews.row',
        array( (object) ['title' => 'Going To The Movies', 'start_time' => '28th Sep 04:00 am', 'guestsNb' => sprintf('%02d', rand(0,5)), 'last' => true] ),
        'event'
      )
    </ul>
</div>
<div class="panel-footer text-right">
  <button class="btn btn-success">Edit</button>
	<button class="btn btn-warning">Disable this Venue</button>
</div>
