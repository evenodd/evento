<template>
    <div>
        <li role="presentation">
            <div data-toggle="modal" v-bind:data-target=" '#venue-details-modal-' + venue.id" class="row">
                <a :href="detailsRoute(venue.id)">
                    <div v-if="venue.canceled" class=" col-xs-7 "><del> {{ venue.name }} </del></div>
                    <div v-else class=" col-xs-7 "> {{ venue.name }} </div>
                    <div class="col-xs-5 text-right">{{ venue.address }}</div>
                </a> 
            </div>
        </li>
    <hr>
    </div>
</template>


<script>
    const sprintf = require("sprintf-js").sprintf;

    export default {
        props: ['venue','show_guests'],
        methods : {
            detailsRoute: function(id) {
                return '/venue/details/' + id;
            }
        }
    }
</script>