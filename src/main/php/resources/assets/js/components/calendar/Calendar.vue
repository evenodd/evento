<template>
    <div>
        <full-calendar 
            :events="calEvents" 
            v-on:eventClick="eventClick">
        </full-calendar>
    </div>
</template>

<script>
    export default {
        props : ['events', 'url'],
        data() {
            return {
                calEvents : () => []
            }
        },
        created : function() {
            this.calEvents = this.events.map(this.eventoToFCEvent);
        },
        methods : {
            eventClick : function(event, jsEvent, pos) {
                window.location.assign(event.url);
            },
            // Converts our own evento object to a full calendar
            // event object. (id & url are custom fields)
            eventoToFCEvent : function(event) {
                return {
                    id : event.id,
                    title : event.title,
                    start : event.start_datetime,
                    end : event.end_datetime,
                    url : this.url + event.id
                };
            }
        },
        watch : {
            'events' : function() {
                this.calEvents = this.events
                    .filter(event => !event.canceled)
                    .map(this.eventoToFCEvent);
            }
        }
    }
</script>