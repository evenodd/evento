<template>
    <div>
        <li role="presentation">
            <div data-toggle="modal" v-bind:data-target=" '#event-details-modal-' + event.id" class="row">
                <a href="#">
                    <div class=" col-xs-7 "> {{ event.title }}</div>
                    <div class="col-xs-5 text-right">{{ event.start_datetime | shortDate }}
                        <span class="ml-1">
                            <button class="sl-2 btn btn-primary btn-xs">Guests 
                                <span class="badge" name="event-guest-nb">{{ event.nbOfGuests }}</span>
                            </button>
                        </span>
                    </div>
                </a> 
            </div>
            <div v-bind:id=" 'event-details-modal-' + event.id" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{ event.title }}</h4>
                        </div>
                        <div class="modal-body">
                            <p> Event Time : <b> {{ event.start_datetime | longDate }} to {{ event.end_datetime | longDate }} </b></p>
                            <!-- TODO Replace this with a global venue row component -->
                            <p> Venue : <b> <a href="#">{{ event.venue }}</a></b></p>
                            <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - -->
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
        props: ['event'],
        created : function () {
            console.log(this);
            var vm = this;
            //request and set the number of guests for the event
            $.get('/eventos/' + this.event.id + '/nbOfGuests', function(res){
                vm.$set(vm.event, 'nbOfGuests', sprintf('%02d', res));
            });
        },
        methods : {
            detailsRoute: function(id) {
                return '/eventos/details/' + id;
            }
        }
    }
</script>