<template>
    <span>
        <a :href="'/venue/details/' + id">{{venue.name}}</a>
    </span>
</template>


<script>
    const sprintf = require("sprintf-js").sprintf;

    export default {
        props: ['id'],
        data () {
            return {
                venue : {
                    name : "..."
                }
            }
        },
        created : function() {
            this.getVenue();
        },
        methods : {
            getVenue : function() {
                $.get({
                    url : '/venue/' + this.id,
                    success : this.setVenue
                });
            },
            setVenue : function(venue) {
                this.venue = venue;
            }
        }
    }
</script>