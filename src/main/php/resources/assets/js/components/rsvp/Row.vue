<template>
	<span class="list-group-item">
	  	<div class="row">
		    <span class="col-xs-5">{{rsvp.email}}</span>
		    <span class="text-right col-xs-7">Accepted:
		    	<span v-if="hasAccepted()">✓</span>
		    	<span v-else>❌</span>
		    </span>
		    <!-- <a class="col-xs-3 text-right">Preferences</a> -->
	    </div>
	</span>
</template>

<script>
	export default {
		props : ['rsvp'],
		methods : {
			hasAccepted : function() {
				console.log(this.rsvp);
				console.log(JSON.parse(this.rsvp.preferences));
				return JSON.parse(this.rsvp.preferences).accepted;
			}
		}
	}
</script>