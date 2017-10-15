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
					v-for="venue in vueVenues" 
					v-bind:venue="venue"
					v-bind:key="venue.id">	
				</venue-row>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        props : {
        	url : {
        		type : String
        	}, 
        	error_message : {
        		type : String
        	},
        	venues : {
        		default : () => []
        	}
    	},

    	data() {
    		return {
    			loading : true,
    			errors : false,
    			vueVenues : () => []
    		}
    	},
        created : function() {
        	this.getVenues();
        	this.vueVenues = this.venues;
        },
        methods : {
        	getVenues : function() {
        		var that = this;
        		$.get({
			        url : this.url,
			        data : {
			        	owner : 'self'
			        },
			        success : function(res) {
			        	that.vueVenues = res;
			        }
			    })
			    .fail(function(errors) {
			    	that.errors = true;
			    })
			    .always(function(res){
			    	that.loading = false;
			    });
        	}
        },
        watch : {
            'vueVenues' : function() {
                this.$emit('input', this.vueVenues);
            },
            'venues' : function() {
            	this.vueVenues = this.venues;
            }
        }
    }
</script>