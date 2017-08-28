<div class="panel-body">
    <ul class="nav nav-pills nav-stacked">
        
        @each('event.subviews.row', array(
            (object)[
                'title' => 'Birthday Party at UTS',
                'start_time' => '28th Sep 04:00 am',
                'guestsNb' => sprintf('%02d', rand(0,99))
            ],
            (object)[
                'title' => 'Post Assignment Party',
                'start_time' => '30th Aug 08:55 am',
                'guestsNb' => sprintf('%02d', rand(0,99))
            ],
            (object)[
                'title' => 'Serious Business Meetup 203',
                'start_time' => '28th Oct 03:00 pm',
                'guestsNb' => sprintf('%02d', rand(0,99))
            ],
            (object)[
                'title' => 'Wedding at Stephanoes',
                'start_time' => '02nd Nov 12:00 pm',
                'guestsNb' => sprintf('%02d', rand(0,99)),
                'last' => true
            ],
        ), 'event')

    </ul>
</div>

<script id="evento-row" type="text/template">
  <li role="presentation">
    <div class="row">
      <a href="#">
        <div name="evento-title" class=" col-xs-4 "></div>
        <div name="evento-date-time" class="col-xs-8 text-right"></div>
        <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs">Guests <span class="badge" name="event-guest-nb"></span></a></span>
      </a> 
    </div>
  </li>
</script>