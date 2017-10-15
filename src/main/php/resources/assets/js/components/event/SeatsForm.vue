<template>
	<b v-if="loading">...</b><b v-else-if="errors"><small>Error, couldn't get seats...  soz</small></b>
    <div v-else>
        <h4>Select an Avaliable seat</h4>
        <div>Avaliable Seats</div>
    	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    	  	<div class="btn-group mr-2" role="group" aria-label="First group">
    	    	<button 
                    v-for="seat in available"
                    v-on:click.prevent="emitInput" 
                    :value="seat"
                    type="button" 
                    class="btn btn-secondary btn-success">
                    {{ seat }}
                </button>
    	    </div>
    	</div>
    	<div>Reserved Seats</div>
    	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
    	    <div class="btn-group mr-2" role="group" aria-label="Second group">
    	       <button v-for="seat in booked" type="button" class="btn btn-secondary btn-danger" disabled>{{ seat }}</button>
    	    </div>
    	</div>
    </div>
</template>

<script>
    export default {
        props : ['event', 'url'],
        data() {
    		return {
    			available : [],
    			booked : [],
    			loading : true,
    			errors : false,
                selected : null
    		}
    	},
        created : function() {
        	this.getSeats();
        },
        methods : {
        	getSeats : function() {
        		var that = this;
        		$.get({
			        url : this.url + this.event.id + '/seats',
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
        	},
            // Should be used as a DOM event handler.
            // Will emit the value attribute of the element 
            // that disbatched the event as an vue 'input' event              
            emitInput: function(e) {
                this.selected = e.target.value;
                this.$emit('input', e.target.value);
            }
        }
    }
</script>