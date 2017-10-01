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
			    <event-row 
					v-for="event in events" 
					v-bind:event="event"
					v-bind:show_guests="show_guests"
					v-bind:key="event.id"
					:redirect="redirect">	
				</event-row>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        props : {
        	show_guests : {
        		type : Boolean
        	}, 
        	url : {
        		type : String
        	}, 
        	redirect : {
        		type : String
        	},
        	error_message : {
        		type : String
        	},
        	events : {
        		default : function(){
                    return () => [];
                }
        	}
    	},
    	data() {
    		return {
    			loading : true,
    			errors : false
    		}
    	},
        created : function() {
        	this.getEvents();
        },
        methods : {
        	getEvents : function() {
        		var that = this;
        		$.get({
			        url : this.url,
			        success : function(res) {
			        	that.events = res;
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
            'events' : function() {
                this.$emit('input', this.events);
            }
        }
    }
</script>