@component('mail::message')

#{{$name}} has invited you have to an event!
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

@component('mail::button', ['url' => url('/rsvp/' . $rsvp->email_token), 'color' => 'blue'])

Accept Invitation

@endcomponent

@component('mail::subcopy')
If you’re having trouble clicking the "Accept Invitation" button, copy and paste the URL below
into your web browser: [{{ url('/rsvp/' . $rsvp->email_token) }}]({{ url('/rsvp/' . $rsvp->email_token) }})
@endcomponent

@endcomponent
 
 {{-- --}}