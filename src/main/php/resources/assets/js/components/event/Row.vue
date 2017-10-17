<template>
    <div>
        <li role="presentation">
            <div data-toggle="modal" v-bind:data-target=" '#event-details-modal-' + event.id" class="row">
                <a href="#">
                    <div v-if="event.canceled" class=" col-xs-7 "><del> {{ event.title }} </del></div>
                    <div v-else class=" col-xs-7 "> {{ event.title }}</div>
                    <div class="col-xs-5 text-right">{{ event.start_datetime | shortDate }}
                        <guest-badge
                            v-if="show_guests"
                            v-bind:event="event"
                            >    
                        </guest-badge>
                        <br>
                        <div>
                            <small v-if="event.price">{{ formatPrice(event.price) }}</small>
                            <small v-else>Free :)</small>
                        </div>
                    </div>
                </a> 
            </div>
            <div v-bind:id=" 'event-details-modal-' + event.id" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 v-if="event.canceled" class="modal-title">Canceled Event: <del>{{ event.title }}</del></h4>
                            <h4 v-else class="modal-title">{{ event.title }}</h4>
                        </div>
                        <div class="modal-body">
                            <p> Event Time : <b> {{ event.start_datetime | longDate }} to {{ event.end_datetime | longDate }} </b></p>
                            <p> Venue : <venue-display :id="event.venue"></venue-display></p>
                            <div v-if="event.price" ><p> Ticket Price : <b> ${{ event.price }} </b></p></div>
                            <div v-if="event.description" ><p> Description : <b> {{ event.description}} </b></p></div>
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <a :href="detailsRoute(event.id)"><h4>More details...</h4></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    <hr>
    </div>
</template>


<script>
    const sprintf = require("sprintf-js").sprintf;

    export default {
        props: ['event','show_guests','redirect'],
        methods : {
            detailsRoute: function(id) {
                return this.redirect + id;
            },
            formatPrice: function(price) {
                return sprintf("$%.2f", price);
            }
        }
    }
</script>