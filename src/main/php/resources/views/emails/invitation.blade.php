@component('mail::message')

# Invitation to {{$event->title}}
{{ $event->description }}
## Venue
{{-- Venue::find($event->venue)->name --}} 
{{-- Venue::find($event->venue)->address --}}

## Time
From: {{ $event->start_datetime }}
To: {{ $event->end_datetime }}


@component('mail::button', ['url' => url('/rsvp/' . $rsvp->email_token), 'color' => 'blue'])

Accept Invitation

@endcomponent

@component('mail::subcopy')
If you’re having trouble clicking the "Accept Invitation" button, copy and paste the URL below
into your web browser: [{{ url('/rsvp/' . $rsvp->email_token) }}]({{ url('/rsvp/' . $rsvp->email_token) }})
@endcomponent

@endcomponent
