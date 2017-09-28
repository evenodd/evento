@component('mail::message')
# THIS EVENT HAS BEEN CANCELED
## {{$event->title}}
{{ $event->description }}
### Venue
{{-- Venue::find($event->venue)->name --}} 
{{-- Venue::find($event->venue)->address --}}

### Time
From: {{ $event->start_datetime }}
To: {{ $event->end_datetime }}

@endcomponent
