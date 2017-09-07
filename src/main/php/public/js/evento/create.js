/**
 * Sets the specified checkbox element to toggle the disabled attribute of the specified input element.
 * 
 * @param checkbox a css selector for the checkbox element 
 * @param input    a css selector for the input element
 */

function initCheckboxEvent(checkbox, input) {
	$(checkbox).change(function () {
        $(input).prop('disabled', !$(this).is(':checked'));
    });
}

function initVenueSelect() {
	$("#createEventForm #venue").select2({
		placeholder : "Select a venue..",
		width : '100%',
		data : [{"id" : 1, "text" : "Jim's Venue"}],
		/*
		
		****Uncomment after venue endpoint is done****

		data : $.get('/venues', function (res) {
			return res.venues.map(function (venue) {
				return {id : venue.id , text : venue.name};
			});
		}),
		
		*/
	});
}

/**
 * Prepopulates the guest selection options with emails 'known' by the current user
 */
function initGuestSelect() {
	$('#createEventForm #guests-list').select2({
		placeholder : "Enter guests email here",
		tags: true,
		disabled: false,
		tokenSeparators: [',', ' '],
		width : '100%',
		data : [],
		/*
		Un-comment when user emails endpoint is done

		data : $.get('user/emails', function (res) {
			console.log(res);
			return res;
		}),
		*/
	});

}

function initSupplierSelect() {
	$('#suppliers').select2({
		placeholder : "Add supplier...",
		data: [],
		width : '100%',
		/*
		
		****Uncomment after supplier endpoint is done****

		data : $.get('/suppliers', function (res) {
			return res.suppliers.map(function (supplier) {
				return {id : supplier.id , text : supplier.name};
			});
		}),
		
		*/
	});
}

function initSeatsSelect() {
	$('#seats').select2({
		placeholder : "Enter Seats (e.g A1,A2,A3,A4,A5,B1...)",
		tags: true,
		tokenSeparators: [',', ' '],
		width : '100%',
		disabled : true
	});
}

/**
 * Overwrites the default submit form event
 */
function initFormSubmitEvent() {
	$('#createEventForm').submit(function(e){
	    e.preventDefault();
	    $.post({
	        url : '/eventos',
	        data : $('#createEventForm').serialize(),
	        //if successful, display an alert and focus on it
	        success : function(res){
	            if (res.status && res.msg) {
		            $('#alertPanel').append(
		            	'<div id="event-alert-' + res.id + '" class="fade in alert alert-' + res.status + '">' + 
		            	'<a href="#" class="close" data-dismiss="alert">&times;</a>' +
		            	res.msg + 
		            	'</div>'
	            	);
		        	$('#event-alert-' + res.id).attr("tabindex",-1).focus();
		        }
	        }
	    });
	});
}

$(document).ready(function() {
	initGuestSelect();
	initSupplierSelect();
	initSeatsSelect();
	initVenueSelect();

	initFormSubmitEvent();

	//init checkbox events
	initCheckboxEvent('#max-guests-checkbox',    "#max-guests");
	initCheckboxEvent('#price-checkbox',         "#price");
	initCheckboxEvent('#rsvp-datetime-checkbox', "#rsvp-datetime");
	initCheckboxEvent('#seats-checkbox',         "#seats");
	initCheckboxEvent('#host-checkbox',          "#host-name, #host-email, #from-host-checkbox");
});