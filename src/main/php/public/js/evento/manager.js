$(document).ready(function(){
	loadAddGuestPopup();
});

function loadAddGuestPopup() {
	$.get('/eventos', function (res) {
		console.log(res);
	
		//Define some test data for demo
		var events = ['Birthday Party at UTS','Post Assignment Party','Serious Business Meetup 203','Wedding at Stephanoes'];
		
		//render dropdown on event select
		$('.evento-select2')
			.select2({
				placeholder : "Select an event",
				data : events
			})
			.val(null).trigger('change')				//Set value to placeholder (i.e. nothing is selected)
			.on('select2:select', onEventSelect);	//Define event to load emails of selected event and add to guest dropdown

		//Init guest dropdown as disabled
		guestSelect = $('.guest-select2').select2({
			placeholder : "Enter guests email here",
			tags: true,
			tokenSeparators: [',', ' '],
			disabled : true,
		});	
	});
}


function onEventSelect(e) {
	console.log(e);
	
	//Get the selected event's list of invited guests
	$.get('/eventos'/* /getguests */,
		{id : e.currentTarget.value}, 
		function (res) {
			console.log(res);
			
			//Test data for demo
			emails = [
				Math.random().toString(36).substring(7) + "@gmail.com",
				Math.random().toString(36).substring(7) + "@gmail.com",
				Math.random().toString(36).substring(7) + "@gmail.com",
				Math.random().toString(36).substring(7) + "@gmail.com",
				Math.random().toString(36).substring(7) + "@gmail.com",
				Math.random().toString(36).substring(7) + "@gmail.com"
			];

			//render dropdown with event emails as options
			guestSelect = $('.guest-select2').select2({
				placeholder : "Enter guests' emails here",
				tags: true,
				tokenSeparators: [',', ' '],
				disabled : false,
				data : emails
			});
			//Add all the emails as the dropdown's selected options
			guestSelect.val(emails).trigger("change");
		}
	);
}