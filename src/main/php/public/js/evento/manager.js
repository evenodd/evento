function Calendar() {
	this. calendar = $('#calendar').fullCalendar({
        header: {
        	right : 'prev, today, next',
        	left : 'title' 
        },
        events: [
	        {
	            title  : 'Birthday Party at UTS',
	            start  : '2017-09-28T04:00:00',
	            allDay : false // will make the time show
	        },
	        {
	            title  : 'Post Assignment Party',
	            start  : '2017-08-30T08:55:00',
	            allDay : false // will make the time show
	        },
	        {
	            title  : 'Serious Business Meetup 203',
	            start  : '2017-10-28T15:00:00',
	            allDay : false // will make the time show
	        },
	        {
	            title  : 'Wedding at Stephanoes',
	            start  : '2017-02-11T12:00:00',
	            allDay : false // will make the time show
           }
	    ]
    });
}

function VenueListPanel(el) {
	this.vue = new Vue({
		el : el,
		data : {
			venues : []
		}
	});
}

$(document).ready(function(){
	loadAddGuestPopup();
	calendar = new Calendar();
	venueList = new VenueListPanel('#venueList')
});

function loadAddGuestPopup() {
	$.get('/eventos', function (res) {
		
		//render dropdown on event select
		$('#evento-input')
			.select2({
				placeholder : "Select an event",
				data : res
			})
			.val(null).trigger('change')				//Set value to placeholder (i.e. nothing is selected)
			.on('select2:select', onEventSelect);	//Define event to load emails of selected event and add to guest dropdown

		//Init guest dropdown as disabled
		guestSelect = $('#add-guests-modal #guests-list-input').select2({
			placeholder : "Enter guests email here",
			tags: true,
			tokenSeparators: [',', ' '],
			disabled : true,
		});	
	});
}

//moves any modals inside another modal outside the modal
function moveStackedModals() {
	$("div.modal  div.modal").appendTo("#managerContainer");
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
			guestSelect = $('#add-guests-modal #guests-list-input').select2({
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