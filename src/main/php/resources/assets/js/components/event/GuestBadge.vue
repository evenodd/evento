<template>
    <span class="ml-1">
        <button class="sl-2 btn btn-primary btn-xs">Guests 
            <span class="badge" name="event-guest-nb">{{ event.nbOfGuests }}</span>
        </button>
    </span>
</template>

<script>
    const sprintf = require("sprintf-js").sprintf;

    export default {
        props: ['event'],
        created : function () {
            var that = this;
            // set the nbOfGuests to '...' while waiting for server response
            this.$set(this.event, 'nbOfGuests', "...");
            //request and set the number of guests for the event
            $.get({
                url : '/eventos/' + this.event.id + '/nbOfGuests',
                success :  function(res) {
                    that.event.nbOfGuests = sprintf('%d', res);
                }
            });
        }
    }
</script>