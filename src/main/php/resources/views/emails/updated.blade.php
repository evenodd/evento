@component('mail::message')

#{{$name}} has updated this event!
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
Please rsvp by: {{ $event->rsvp_datetime }}
@endif
@endcomponent