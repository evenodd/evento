{{-- 
    Params:
    Venue $venue
--}}
<div class="panel-heading">
    <b>{{ $venue->name }}</b>
</div>
<div class="panel-body">
    <ul class="nav nav-pills nav-stacked">
        <li> Address : <b> {{ $venue->address }} </b></li>
        <li> Contacts :
            <ul>
                @foreach(json_decode($venue->contact, true) as $key => $c)
                    <li>{{ $key }}: <b> {{ $c }} </b></li>
                @endforeach
            </ul>
        </li>
        <li> max Capacity : <b> {{ $venue->capacity }} people </b></li>
    </ul>
    <ul class="nav nav-pills nav-stacked">
        <hr>
        <p><b> Events using this venue: </b></p> 
        <event-list v-bind:events="events" id="event-list"></event-list>
    </ul>
</div>
<div class="panel-footer text-right">
    <button class="btn btn-success">Edit</button>
	<button class="btn btn-warning">Disable this Venue</button>
</div>