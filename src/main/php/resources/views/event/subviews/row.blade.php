{{--
Params:
    object  $event contains event information
--}}
<li role="presentation">
    <div class="row">
        <a href="#">
            <div class=" col-xs-4 "> {{ $event->title }}</div>
            <div class="col-xs-8 text-right">{{ $event->start_time }}
                <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs">Guests <span class="badge" name="event-guest-nb">{{ $event->guestsNb }}</span></button></span>
            </div>
        </a> 
    </div>
</li>

@if (property_exists($event, 'last'))
	<br>
@else
	<hr>
@endif