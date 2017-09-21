<template>
    <div>
        <li role="presentation">
            <div data-toggle="modal" data-target="#event-details-modal" class="row">
                <a href="#">
                    <div class=" col-xs-8 "> {{ event.title }}</div>
                    <div class="col-xs-4 text-right">{{ event.start_datetime | shortDate }}
                        <span class="ml-1"><button class="sl-2 btn btn-primary btn-xs">Guests <span class="badge" name="event-guest-nb">{{ event.guestsNb }}</span></button></span>
                    </div>
                </a> 
            </div>
            <div id="event-details-modal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{ event.title }}</h4>
                        </div>
                        <div class="modal-body">
                            <p> Event Time : <b> {{ event.start_datetime | longDate }} to {{ event.end_datetime | longDate }} </b></p>
                            <p> Venue : <b> <a href="#">{{ event.venue }}</a></b></p>
                            <p> Ticket Price : <b> ${{ event.price }} </b></p>
                            <p> Description : <b> {{ event.description}} </b></p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
    <hr>
    </div>
</template>


<script>
    export default {
        props: ['event']
    }
</script>