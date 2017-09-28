<template>
    <div>
        <full-calendar 
            :events="events" 
            @dayClick="dayClick">
        </full-calendar>
    </div>
</template>

<script>
    export default {
        props : ['events'],
        methods : {
            'eventClick' (event, jsEvent, pos) {
                window.location.replace(event.url);
            }
        }
    }
</script>