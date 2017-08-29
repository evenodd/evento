{{--
Params:
    object  $event contains event information
--}}
<li role="presentation">
    <div data-toggle="modal" data-target="#event-details-modal" class="row">
        <a href="#">
            <div class=" col-xs-4 "> {{ $event->title }}</div>
            <div class="col-xs-8 text-right">{{ $event->start_time }}
                <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs">Guests <span class="badge" name="event-guest-nb">{{ $event->guestsNb }}</span></button></span>
            </div>
        </a> 
    </div>
</li>
<div id="event-details-modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ $event->title }}</h4>
            </div>
            <div class="modal-body">
                <p> Event Time : <b> 20/01/2017 3.30pm to 21/01/2017 1.00am </b></p>
                <p> Venue : <b> <a href="#">Stephanos Winery Australia</a></b></p>
                <p> Ticket Price : <b> $00.00 </b></p>
                <p> Description : <b> finally getting married </b></p>
                @if(Request::is("*/public" ))
                    <button class="btn btn-success">Book Event</button>
                @endif
            </div>
        </div>
    </div>
</div>



@if (property_exists($event, 'last'))
	<br>
@else
	<hr>
@endif