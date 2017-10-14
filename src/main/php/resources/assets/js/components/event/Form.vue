<template>
	<form id="createEventForm" class="form-horizontal" method="POST" action="/eventos">

	    <div class="form-group">
	        <label for="title" class="col-md-4 control-label">Event Title</label>
	        <div class="col-md-6">
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
	        <label for="description" class="col-md-4 control-label">Description</label>
	        <div class="col-md-6">
	            <textarea 
	            	v-model="event.description"
	            	id="description" 
	            	type="text" 
	            	class="form-control" 
	            	name="description">
            	</textarea>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="start-datetime" class="col-md-4 control-label">From</label>
	        <div class="col-md-6">
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
	        <label for="end-datetime" class="col-md-4 control-label">To</label>
	        <div class="col-md-6">
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
	        <label for="venue" class="col-md-4 control-label">Venue</label>
	        <div class="col-md-6">
                <select 
                	v-model="event.venue"
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
		    <label for="max-guests-input" class="col-md-4 control-label">Invite Guests</label>
		    <div class="col-md-6">
		        <select 
		        	v-model="event.guests"
		        	id="guests-list" 
		        	class="form-control" 
		        	name="guests-list" 
		        	style="width: 100%" 
		        	multiple="multiple">
		        </select>
		    </div>
		</div>

	    <div class="form-group">
	        <label for="host-name" class="col-md-4 control-label">Host</label>
	        <div class="col-md-6">
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
	                	disabled="true">
	            </div>
	        </div>
	        <div class="col-md-6 col-md-offset-4">
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <input 
	                    	v-model="event.from_host"
	                    	id="from-host-checkbox" 
	                    	type="checkbox" 
	                    	class="" 
	                    	name="from-host-checkbox" 
	                    	title="Enabling this option will send invitations addressed from the host (opposed to by you)" 
	                    	disabled="true">
	                </span>
	                <span class="input-group-addon text-left" style="width: 100%;">
	                    Invitations sent from host
	                </span>
	            </div>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="rsvp-datetime" class="col-md-4 control-label">RSVP</label>
	        <div class="col-md-6">
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <input 
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
	                	disabled="true">
	            </div>
	        </div>
	    </div>


	    <div class="form-group">
	        <label for="max-guests" class="col-md-4 control-label">Max Guests</label>
	        <div class="col-md-6">
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <input 
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
	                	disabled="true">
	            </div>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="price" class="col-md-4 control-label">Ticket Price</label>
	        <div class="col-md-6">
	            <div class="input-group">
	                <span class="input-group-addon">
	                    <input 
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
	                	disabled="true">
	            </div>
	        </div>
	    </div>

	    <div class="form-group">
	        <label for="seats" class="col-md-4 control-label">Seat Numbers</label>
	        <div class="col-md-6">
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
	        <label for="suppliers" class="col-md-4 control-label">Suppliers</label>
	        <div class="col-md-6">
	            <div class="input-group">
	                <select 
	                	id="suppliers" 
	                	class="form-control seat-select2" 
	                	placeholder="Select Supplier" 
	                	name="suppliers" 
	                	style="width: 100%" 
	                	multiple="multiple">
                	</select>
	                <span class="input-group-addon"> 
	                    <a target="_blank" href="/supplier">Or Submit new Supplier</a>
	                </span>
	            </div>
	        </div>
	    </div>

	    <div class="form-group">
	        <label class="text-right col-md-6 col-md-offset-6" for="public-private">
	        	Private
		        <input 
		        	v-model="event.private"
		        	id="private" 
		        	type="radio" 
		        	value="private" 
		        	name="public-private" 
		        	checked="checked">
	        </label>
	        <label class="text-right col-md-6 col-md-offset-6" for="public-private">
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
	        <div class="text-right col-md-6 col-md-offset-6">
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
				seatsEnabled : false
			}
		},
		created : function() {
			this.event.start_datetime = moment(this.event.start_datetime, "yyyy-MM-dd hh:mm:ss").format("YYYY-MM-DDThh:mm")
			this.event.end_datetime = moment(this.event.end_datetime, "yyyy-MM-dd hh:mm:ss").format("YYYY-MM-DDThh:mm")
			
			// bind seats object. Will be set to [] if event preferences doesnr contain seats
			this.$set(this.event, 'seats', 
				typeof JSON.parse(this.event.preferences).seats != 'undefined' ? JSON.parse(this.event.preferences).seats : []
			);
			// enable the seats input if the seats array is not empty
			if (this.event.seats.length > 0)
				this.seatsEnabled = true;

			this.$set(this.event, 'guests', []);
		},
		mounted : function() {
			$('#seats').select2({
		        placeholder : "Enter Seats (e.g 1,2,3,4,5...)",
		        tags: true,
		        tokenSeparators: [',', ' '],
		        width : '100%',
		        data : this.event.seats,
		        disabled : !this.seatsEnabled
		    });
		    $('#seats').val(this.event.seats).trigger('change');
			this.$set(this.event, 'seats', this.event.seats);
		},
		methods : {
			GuestSelect : function(el) {
				el.select2({
			        placeholder : "Enter guests email here",
			        tags: true,
			        disabled: false,
			        tokenSeparators: [',', ' '],
			        width : '100%',
			        data : [],
			    });
			},
			SeatSelect : function(el, seats = [], disabled = false) {
				this.el = el;
				this.el.select2({
		        placeholder : "Enter Seats (e.g 1,2,3,4,5...)",
		        tags: true,
		        tokenSeparators: [',', ' '],
		        width : '100%',
		        data : seats,
		        disabled : disabled
			    });
			    this.el.val(seats).trigger('change');

			    var that = this;

			    var autoPopHandler = function(e) {
			    	e.preventDefault();
			        
			        var max = that.el.val() != null ? that.el.val() : 5;

			        var array = [];
			        
			        for (var i=1; i<=max; i++)
			            array.push(i);

			        $('#seats').select2({
			                placeholder : "Enter guests' seats here",
			                tags: true,
			                tokenSeparators: [',', ' '],
			                disabled : false,
			                data :  array
			            });

			        $('#seats').val(array).trigger('change');
			    }		
			},
			SupplierSelect : function(el) {
				el.select2({
			        placeholder : "Add supplier...",
			        data: [],
			        width : '100%',
			    });
			},
			VenueSelect : function() {
			     var that = this;
			     this.el = $("#venue")
			     this.el.select2({
			        placeholder : "Loading venues..",
			        width : '100%',
			        data : []
			    });

			    this.venueDataTransform = function(venue) {
				    return {id : venue.id , text : venue.name};
				};

			    this.setVenues = function(venues) {
			        that.el.select2({
			            placeholder : "Select a venue..",
			            width : '100%',
			            data : venues.map(that.venueDataTransform)
			        });
			    }

			    this.getVenues = function(callbacks) {
				    $.get({
				        url : '/venues', 
				        success : callbacks.success
				    });   
				};

			    this.getVenues({
			        success : this.setVenues
			    });
			    
			}

			VenueSelect.prototype.getVenues = function(callbacks) {
			    $.get({
			        url : '/venues', 
			        success : callbacks.success
			    });   
			};

			VenueSelect.prototype.selectVenueModel = function(venue) {
			    var option = new Option(venue.name, venue.id);
			    option.selected = true;
			    this.el.append(option);
			    this.el.trigger('change');
			};

		}        
    }
</script>