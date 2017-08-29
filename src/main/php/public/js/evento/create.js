$(document).ready(function(){
	//Render guest email select
	$('#createEventForm #guests-list-input').select2({
		placeholder : "Enter guests email here",
		tags: true,
		disabled: false,
		tokenSeparators: [',', ' '],
		data : $.get('user/emails', function (res) {
			console.log(res);
			return res;
		})
	});
	$('#suppliers-input').select2({
		placeholder : "Add supplier...",
		data: ['Jims Catering']
	});

	$('#seats-input').select2({
		placeholder : "Enter Seats (e.g A1,A2,A3,A4,A5,B1...)",
		tags: true,
		tokenSeparators: [',', ' '],
		disabled : true
	});


	//init checkbox events
	initCheckboxEvent('#max-guests-checkbox',"#max-guests-input");
	initCheckboxEvent('#price-checkbox',"#price-input");
	initCheckboxEvent('#rsvp-datetime-checkbox',"#rsvp-datetime-input");
	initCheckboxEvent('#seats-checkbox',"#seats-input");
	initCheckboxEvent('#host-checkbox',"#host-name-input, #host-email-input, #from-host-checkbox");
});

function initCheckboxEvent(checkbox, input) {
	$(checkbox).change(function () {
        $(input).prop('disabled', !$(this).is(':checked'));
    });
}