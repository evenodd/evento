<template>
	<form id="createVenueForm" class="form-horizontal" method="POST">
	    <input type="hidden" name="_token" :value="token">

	    <div class="form-group">
	        <label for="venueName" class="col-md-4 control-label">Venue Name</label>
	        <div class="col-md-6">
	            <input 
	            	v-model="venue.name"
	            	id="venueName" 
	            	type="text" 
	            	class="form-control" 
	            	name="venueName"  
	            	placeholder="New Venue Name" 
	            	required 
	            	autofocus>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="address" class="col-md-4 control-label">Address</label>
	        <div class="col-md-6">
	            <input 
		            v-model="venue.address"
		            id="address" 
		            type="int" 
		            class="form-control" 
		            name="address">
	        </div>
	    </div>

        <div class="form-group"> 
	        <label for="max-capacity" min="1" class="col-md-4 control-label">Max Capacity</label>
	        <div class="col-md-6">
	            <input 
	            	v-model="venue.capacity"
	            	id="max-capacity" 
	            	type="number"
	            	class="form-control" 
	            	name="max-capacity" 
	            	required>
	        </div>
	    </div>

	    <div id="contactsFormGroup" class="form-group">
	        <label for="hidden" class="col-md-4 control-label">Contact Details:</label>
	        <contact-inputs
	            :contacts="currContacts"
	            v-on:contacts_changed="updateContacts">
	        </contact-inputs>
	    </div>
	    <div class="form-group">
	        <div class="text-right col-md-6 col-md-offset-4">
	            <button type="submit" class="btn btn-primary" v-on:click.prevent="updateVenue">
	                Submit
	            </button>
	        </div>
	    </div>
	</form>
</template>

<script>
	export default {
        props: {
        	venue : {
        		default: () => null
        	},
        	contacts : {
        		default : () => [
			        {
			            name : "Phone", 
			            value : ''
			        },
			        {
			            name : "Email",
			            value : ''
			        }
			    ]
        	},
        	token : {}
		},
		data() {
			return {
				currContacts : () => []
			}
		},
		created : function() {
			//set the contacts default value
			this.currContacts = this.contacts;
			if (this.venue) {
				// convert the venue's contact string to an object
				var venueContacts = JSON.parse(this.venue.contact)
				this.venue._token = this.token;
				// convert the contacts object to an array of contacts used
				// by the contacts input component
				this.currContacts = Object.keys(venueContacts).map(key => ({
					name : key,
					value : venueContacts[key]
				}));
			}
		},
		methods : {
			updateVenue : function(e) {
				var that = this;
				$.post({
					url : '/venue/update/' + this.venue.id,
					data : this.venue,
					success : function(res) {
						window.location.assign('/venue/details/' + that.venue.id);
					}
				}).fail(function(res) {
					that.$emit('failed', res);
				});
			},
			updateContacts : function(contacts) {
			    var data = new Object();
		        // filter out contact fields with empty values
			    contacts.filter(contact => $.inArray(contact.value, ['', null, 'undefined']) == -1)
			        // add each contact field and value into the data Object
			        .forEach(function(contact) {
			            data[contact.name] = contact.value;
			        });
			    this.venue.contact = JSON.stringify(data);
			}
		} 
    }
</script>