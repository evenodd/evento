<template>
	<span><b v-if="loading">...</b><b v-if="errors"><small>Error, couldn't get seats...  soz</small></b>
		<b 
			v-for="(seat, i) in available"
			v-if="i < 10">
			<b>{{ seat }}
				<b v-if="!(i == (available.length - 1) || i == 9)">, </b>
			</b>
		</b>
	    <button 
	    	class="btn btn-xs btn-default" 
	    	data-toggle="modal" 
	    	data-target="#show-seats-modal">
	        <span class="" name="event-guest-nb">
	        	+
	        	<span v-if="available.length > 10">
		        	{{ available.length - 10 }}
		        </span>
	        	 More...
        	</span>
	    </button>
	    <div id="show-seats-modal" class="modal fade" role="dialog">
	        <div class="modal-dialog">
	            <div class="modal-content">
	                <div class="modal-header">
	                    <button type="button" class="close" data-dismiss="modal">&times;</button>
	                    <h4 class="modal-title">Event Seats</h4>
	                </div>
	                <div class="modal-body">
	                    <div>Avaliable Seats</div>
						<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
						  <div class="btn-group mr-2" role="group" aria-label="First group">
						    <button v-for="seat in available" type="button" class="btn btn-secondary btn-success">{{ seat }}</button>
						  </div>
						</div>
						<div>Reserved Seats</div>
						<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
						  <div class="btn-group mr-2" role="group" aria-label="Second group">
						    <button v-for="seat in booked" type="button" class="btn btn-secondary btn-danger">{{ seat }}</button>
						  </div>
						</div>
	                </div>
	            </div>
	        </div>
	    </div>
	</span>
</template>

<script>
    export default {
        props : ['event'],
        data() {
    		return {
    			available : [],
    			booked : [],
    			loading : true,
    			errors : false
    		}
    	},
        created : function() {
        	this.getSeats();
        },
        methods : {
        	getSeats : function() {
        		var that = this;
        		$.get({
			        url : '/eventos/details/' + this.event.getId() + '/seats',
			        success : function(res) {
			        	that.available = res.available;
			        	that.booked = res.booked;
			        }
			    })
			    .fail(function(errors) {
			    	that.errors = true;
			    })
			    .always(function(res){
			    	that.loading = false;
			    });
        	}
        }
    }
</script>