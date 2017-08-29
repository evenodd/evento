{{--
Params:
    object[] $events - any array of event objects

--}}
<div class="panel-body">
    <ul class="nav nav-pills nav-stacked">
        
        @each('event.subviews.row', $events, 'event')

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