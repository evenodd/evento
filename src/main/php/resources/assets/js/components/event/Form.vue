<template>
	<form 
		v-on:submit.prevent="submitEvent"
		id="createEventForm" 
		class="form-horizontal" 
		method="POST" 
		action="/eventos">
		<full-loader :show="loading"></full-loader>
		<input type="hidden" name="_token" :value="token">

	    <div class="form-group">
	        <label for="title" class="col-md-3 control-label">Event Title</label>
	        <div class="col-md-9">
	            <input 
	            	v-model="event.title"
	            	id="title" 
	            	type="text" 
	            	class="form-control" 
	            	name="title" 
	            	placeholder="My Event" 
	            	required 
	            	autofocus>
	        </div>
	    </div>


	    <div class="form-group">
	        <label for="description" class="col-md-3 control-label">Description</label>
	        <div class="col-md-9">
	            <textarea 
	            	v-model="event.description"
	            	id="description" 
	            	type="text" 
	            	style="height : 150px;"
	            	class="form-control" 
	            	name="description">
            	</textarea>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="start-datetime" class="col-md-3 control-label">From</label>
	        <div class="col-md-9">
	            <input 
	            	v-model="event.start_datetime"
	            	id="start-datetime" 
	            	type="datetime-local" 
	            	class="form-control" 
	            	name="start-datetime" 
	            	required 
	            	placeholder="Starting at">
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="end-datetime" class="col-md-3 control-label">To</label>
	        <div class="col-md-9">
	            <input 
		            v-model="event.end_datetime"
	            	id="end-datetime" 
	            	type="datetime-local" 
	            	class="form-control" 
	            	name="end-datetime" 
	            	required 
	            	placeholder="Ending at">
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="venue" class="col-md-3 control-label">Venue</label>
	        <div class="col-md-9">
                <select 
                	id="venue" 
                	class="form-control" 
                	name="venue" 
                	required 
                	placeholder="Select Venue">
                    <option val=""></option>
                </select>
	        </div>
	    </div>

	    <div class="form-group">
		    <label for="max-guests-input" class="col-md-3 control-label">Invite Guests</label>
		    <div class="col-md-9">
		        <select 
		        	id="guests-list" 
		        	class="form-control" 
		        	name="guests-list" 
		        	style="width: 100%" 
		        	multiple="multiple">
		        </select>
		    </div>
		</div>

	    <div class="form-group">
	        <label for="host-name" class="col-md-3 control-label">Host</label>
	        <div class="col-md-9">
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <input 
	                    	v-model="hostEnabled"
	                    	id="host-checkbox" 
	                    	type="checkbox" 
	                    	aria-label="Set the host">
	                </span>
	                <input 
	                	v-model="event.host_name"
	                	id="host-name" 
	                	type="text" 
	                	class="form-control" 
	                	name="host-name" 
	                	placeholder="Host name" 
	                	:disabled="!hostEnabled">
	                <input 
	                	v-model="event.host_email"
	                	id="host-email" 
	                	type="email" 
	                	class="form-control" 
	                	name="host-email" 
	                	placeholder="Host email" 
	                	:disabled="!hostEnabled">
	            </div>
	        </div>
	        <div class="col-md-9 col-md-offset-3">
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <input 
	                    	v-model="event.from_host"
	                    	id="from-host-checkbox" 
	                    	type="checkbox" 
	                    	class="" 
	                    	name="from-host-checkbox" 
	                    	title="Enabling this option will send invitations addressed from the host (opposed to by you)" 
		                	:disabled="!hostEnabled">
	                </span>
	                <span class="input-group-addon text-left" style="width: 100%;">
	                    Invitations sent from host
	                </span>
	            </div>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="rsvp-datetime" class="col-md-3 control-label">RSVP</label>
	        <div class="col-md-9">
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <input 
	                    	v-model="rsvpEnabled"
	                    	id="rsvp-datetime-checkbox" 
	                    	type="checkbox" 
	                    	aria-label="Enable RSVP">
	                </span>
	                <input 
		                v-model="event.rsvp_datetime"
	                	id="rsvp-datetime" 
	                	type="datetime-local" 
	                	class="form-control" 
	                	name="rsvp-datetime" 
	                	required 
	                	placeholder="Ending at" 
	                	:disabled="!rsvpEnabled">
	            </div>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="max-guests" class="col-md-3 control-label">Max Guests</label>
	        <div class="col-md-9">
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <input 
	                    	v-model="max_guestsEnabled"
	                    	id="max-guests-checkbox" 
	                    	type="checkbox" 
	                    	aria-label="Enable Max Guests">
	                  </span>
	                <input 
	                	v-model="event.max_guests"
	                	id="max-guests" 
	                	type="number" 
	                	min="1" 
	                	class="form-control" 
	                	name="max-guests" 
	                	required 
	                	:disabled="!max_guestsEnabled">
	            </div>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="price" class="col-md-3 control-label">Ticket Price</label>
	        <div class="col-md-9">
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <input 
	                    	v-model="priceEnabled"
	                    	id="price-checkbox" 
	                    	type="checkbox" 
	                    	aria-label="Enable Ticket Price">
	                </span>
	                <input 
	                	v-model="event.price"
	                	id="price" 
	                	type="text" 
	                	min="0" 
	                	class="form-control" 
	                	style="outline: none;" 
	                	name="price" 
	                	placeholder="00.00" 
	                	:disabled="!priceEnabled">
	            </div>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="seats" class="col-md-3 control-label">Seat Numbers</label>
	        <div class="col-md-9">
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <input 
	                    	v-model="seatsEnabled"
	                    	id="seats-checkbox" 
	                    	type="checkbox" 
	                    	aria-label="Enable Seats">
	                </span>
	                <select 
	                	id="seats" 
	                	class="form-control seat-select2" 
	                	name="seats" 
	                	style="width: 100%" 
	                	multiple="multiple"
	                	:disabled="!seatsEnabled">
                	</select>
	                <span class="input-group-btn">  
	                    <button 
	                    	v-on:click.prevent="handleAutoPopulateClick"
	                    	class ="btn btn-secondary" 
	                    	id="auto_pop_button" 
		                	:disabled="!seatsEnabled">
	                    	Auto populate
	                    </button> 
	                </span>
	            </div>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="suppliers" class="col-md-3 control-label">Suppliers</label>
	        <div class="col-md-9">
	            <div class="input-group">
	                <select 
	                	id="suppliers" 
	                	class="form-control seat-select2" 
	                	placeholder="Select Supplier" 
	                	name="suppliers" 
	                	style="width: 100%" 
	                	multiple="multiple">
                	</select>
	            </div>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="text-right col-md-9 col-md-offset-3" for="public-private">
	        	Private
		        <input 
		        	v-model="event.private"
		        	id="private" 
		        	type="radio" 
		        	value="private" 
		        	name="public-private" 
		        	checked="checked">
	        </label>
	        <label class="text-right col-md-9 col-md-offset-3" for="public-private">
	        	Public
	        	<input 
	        		v-model="event.private"
	        		id="public" 
	        		type="radio" 
	        		value="public" 
	        		name="public-private">
        	</label>
	    </div>

	    <div class="form-group">
	        <div class="text-right col-md-9 col-md-offset-3">
	            <button 
	            	type="submit" 
	            	class="btn btn-primary">
	                Submit
	            </button>
	        </div>
	    </div>
	</form>
</template>

<script>
	export default {
        props: {
        	event : {
        		default: () => null
        	},
        	token : {
        		default : () => $("meta[name='csrf-token']").attr("content")
        	}
		},
		data() {
			return {
				hostEnabled : false,
				seatsEnabled : false,
				rsvpEnabled : false,
				max_guestsEnabled : false,
				priceEnabled : false,
				loading : false
			}
		},
		created : function() {
			this.formatDates();

			this.event.private = this.event.private ? 'private' : 'public';

			// bind seats object. Will be set to [] if event preferences doesnt contain seats
			this.$set(this.event, 'seats', 
				typeof JSON.parse(this.event.preferences).seats != 'undefined' ? JSON.parse(this.event.preferences).seats : []
			);

			// enable the seats input if the seats array is not empty
			if (this.event.seats.length > 0)
				this.seatsEnabled = true;

			// enable host data if it is all defined
			if (this.event.host_name && this.event.host_name.length > 0 &&
				this.event.host_email && this.event.host_email.length > 0)
				this.hostEnabled = true;

			if (this.event.rsvp_datetime)
				this.rsvpEnabled = true;
			
			if (this.event.max_guests)
				this.max_guestsEnabled = true;

			if (this.event.price)
				this.priceEnabled = true;

		},
		mounted : function() {
			this.venueSelect = this.VenueSelect(this.event.venue).render(); 
			
			this.guestSelect = this.GuestSelect(
				$('#guests-list'), 
				this.event
			).render();
			
			this.seatsSelect = this.SeatSelect(
				$('#seats'), 
				this.event.seats, 
				!this.seatsEnabled
			).render();

			this.supplierSelect = this.SupplierSelect($('#suppliers'))
				.render();
		},
		methods : {
			submitEvent : function(e) {
				var that = this;
				this.loading = true;	
				$.post({
					url : '/eventos/update/' + this.event.id,
					data : this.getData(),
					success : function(res) {
						window.location.assign('/eventos/details/' + 
							that.event.id);
					}
				}).fail(function(res) {
					that.$emit('failed', res);
					that.loading = false;
				});
			},

			getData : function() {
				return this
					.SerializedArray($('#eventForm').serializeArray())
					.indexDuplicateNames(['guests-list', 'seats'])
					.serializedArray;
			},

			formatDates : function() {
				this.event.start_datetime = moment(
					this.event.start_datetime, 
					"YYYY-MM-DD HH:mm:ss"
				).format("YYYY-MM-DDTHH:mm");

				this.event.end_datetime = moment(
					this.event.end_datetime,
					"YYYY-MM-DD HH:mm:ss"
				).format("YYYY-MM-DDTHH:mm");

				if(this.event.rsvp_datetime)
					this.event.rsvp_datetime = moment(
						this.event.rsvp_datetime,
						"YYYY-MM-DD HH:mm:ss"
				).format("YYYY-MM-DDTHH:mm");
			},

			handleAutoPopulateClick : function(e) {
				var max = this.event.max_guests ? this.event.max_guests : 5;
				var seats = [];
				var i = 0;
				while(i < max)
					seats.push(++i);
				this.seatsSelect.render(seats);
			},

			VenueSelect : function(initValue) {
			    return {
			    	el : $("#venue"),
			    	initValue : initValue,
			    	venueDataTransform : function(venue) {
					    return {id : venue.id , text : venue.name};
					},
					setVenues : function(venues) {
				        this.el.select2({
				            placeholder : "Select a venue..",
				            width : '100%',
				            data : venues.map(this.venueDataTransform)
				        });
				        this.el.val(this.initValue).trigger('change');
				    },
					getVenues : function(callbacks) {
					    $.get({
					        url : '/venues', 
					        success : callbacks.success
					    });   
					},
					render : function() {
						this.el.select2({
					        placeholder : "Loading venues..",
					    	width : '100%',
					        data : []
					    });
					    this.setVenues = this.setVenues.bind(this);
					    this.getVenues({
					        success : this.setVenues
					    });
					    return this;
					}
			    }
			},

			GuestSelect : function(el, event) {
				return {
					el : el,
					event : event,
					getGuests : function(callbacks) {
						$.get({
							url : '/eventos/' + this.event.id + '/rsvps',
							success : callbacks.success
						}).fail(callbacks.fail);
					},
					setGuests : function(guests) {
						var guests = guests.map(guest => guest.email);
						this.el.select2({
					        placeholder : "Enter guests email here",
					        tags: true,
					        disabled: false,
					        tokenSeparators: [',', ' '],
					        width : '100%',
					        data : guests,
					    });
	    			    el.val(guests).trigger('change');
					},
					displayError : function(errors) {
						this.el.select2({
					        placeholder : "Error loading Guests",
					        disabled: true,
					        width : '100%',
					        data : []
					    });
					},
					render : function() {
						this.el.select2({
					        placeholder : "Loading Guests..",
					        disabled: true,
					        width : '100%',
					        data : [],
						});

					    this.setGuests = this.setGuests.bind(this);
					    this.displayError = this.displayError.bind(this);
						
						this.getGuests({
							success : this.setGuests,
							fail : this.displayError
						});
						return this;
					}					
				}
			},

			SeatSelect : function(el, seats = [], disabled = false) {
			    return {
			    	el : el,
			    	seats : seats,
			    	disabled : disabled,
				    render : function(seats) {
						if (typeof seats != 'undefined')
							this.seats = seats;

						this.el.select2({
					        placeholder : "Enter Seats (e.g 1,2,3,4,5...)",
					        tags: true,
					        tokenSeparators: [',', ' '],
					        width : '100%',
					        data : this.seats,
					        disabled : this.disabled
					    });
					    this.el.val(this.seats).trigger('change');
					    return this;
				    }		
			    }
			},
			SupplierSelect : function(el) {
				return {
					el : el,
					render : function() {
						this.el.select2({
					        placeholder : "Add supplier...",
					        data: [],
					        width : '100%',
					        disabled : true
					    });
					    return this;
					}
				}
			},
			SerializedArray : function(serializedArray) {
			    return {
			    	serializedArray : serializedArray,
					/**
					 * Returns the serialized array with an index appended to the specified names.
					 * 
					 * E.g [{name : 'a', value : 1},{name : 'a', value : bar2}] ;
					 *     becomes 
					 *     [{name : 'a[0]', value : bar},{name : 'a[1]', value : bar2}] 
					 *     when ['a'] is passed as a name
					 *
					 * @param arr   the serialized array 
					 * @param names the names to index
					 * @return an array of values
					 */
					indexDuplicateNames : function(names) {
					    var indexes = [];
					    names.forEach(function(name) {
					        indexes[name] = 0;
					    });
					    this.serializedArray.forEach(function(e) {
					        // If the element's name is one of the names append 
					        // an index an increment that name's index
					        if (names.indexOf(e.name) != -1)
					            e.name += '[' + (indexes[e.name]++) + ']';
					    });
					    return this;
					}
			    }
			}
		}        
    }
</script>