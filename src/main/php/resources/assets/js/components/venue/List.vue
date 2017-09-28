<template>
	<div>
		<div class="center-block">
	        <p v-if="errors">{{ error_message }}</p> 
	    </div>
	    <div class="row">
	        <div class="col-xs-2 col-xs-offset-5">
	            <pacman-loader 
	            	:loading="loading" 
	            	color="grey" 
	            	size="30px">
            	</pacman-loader>
	        </div>
	    </div>
        <div style="max-height:400px; overflow-y:auto; overflow-x: hidden;">
			<div class="nav nav-pills nav-stacked">
			    <venue-row 
					v-for="venue in venues" 
					v-bind:venue="venue"
					v-bind:key="venue.id">	
				</venue-row>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        props : [
        	'show_guests', 
        	'url', 
        	'error_message'
    	],
    	data() {
    		return {
    			venues : [],
    			loading : true,
    			errors : false
    		}
    	},
        created : function() {
        	this.getVenues();
        },
        methods : {
        	getVenues : function() {
        		var that = this;
        		$.get({
			        url : this.url,
			        success : function(res) {
			        	that.venues = res;
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