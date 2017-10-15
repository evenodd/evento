@component('mail::message')
#{{$name}} has CANCELED this event!
##Event name 
{{$event->title}}
## Event description <br> 
{{ $event->description }} 
## Venue
{{ $venue->name  }} <br>
{{ $venue->address }}

## Time
From: {{ $event->start_datetime }} <br>
To: {{ $event->end_datetime }}

@if($event->price)
## Ticket Price
${{ $event->price }}
@endif

@if($event->rsvp_datetime)
## RSVP
rsvp by: {{ $event->rsvp_datetime }}
@endif
@endcomponent
