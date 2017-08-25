<div class="container">
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">        
          <div class="panel-heading"><b>My Events</b></div>
          <div class="panel-body">
             <ul class="nav nav-pills nav-stacked">
                                      
                <li role="presentation">
                  <div class="row">
                    <a href="#">
                      <div class=" col-xs-4 "> Birthday Party at UTS</div>
                      <div class="col-xs-8 text-right">28th Sep 04:00 am
                        <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs">Guests <span class="badge" name="event-guest-nb">{{rand(0,100)}}</span></button></span>
                      </div>
                    </a> 
                  </div>
                </li>

                <hr>

                <li role="presentation">
                  <div class="row">
                    <a href="#">
                      <div class=" col-xs-4 "> Post Assignment Party</div>
                      <div class="col-xs-8 text-right">30th Aug 08:55 am
                        <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs">Guests <span class="badge" name="event-guest-nb">{{rand(0,100)}}</span></button></span>
                      </div>
                    </a> 
                  </div>
                </li>

                <hr>

                <li role="presentation">
                  <div class="row">
                    <a href="#">
                      <div class=" col-xs-4 "> Serious Business Meetup 203</div>
                      <div class="col-xs-8 text-right">28th Oct 3:00 pm
                        <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs">Guests <span class="badge" name="event-guest-nb">{{rand(0,100)}}</span></button></span>
                      </div>
                    </a> 
                  </div>
                </li>

                <hr>

                <li role="presentation">
                  <div class="row">
                    <a href="#">
                      <div class=" col-xs-4 "> Wedding at Stephanoes</div>
                      <div class="col-xs-8 text-right">02nd Nov 12:00 pm
                        <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs">Guests <span class="badge" name="event-guest-nb">{{rand(0,100)}}</span></button></span>
                      </div>
                    </a> 
                  </div>
                </li>

                <br>

              </ul>
          </div>
      </div>
    </div>
  </div>
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