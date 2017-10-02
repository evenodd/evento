// function Calendar(el) {
// 	this.vue = new Vue({
// 		el : el,
// 		data : {
// 			events : window.events
// 		}
// 	});
// }

// function VenueListPanel(el) {
// 	this.vue = new Vue({
// 		el : el,
// 		data : {
// 			venues : window.venues
// 		}
// 	});
// }


// function EventList(el){
//     this.vue = new Vue({
//         el : el,
//         data : {
//         	events : window.events
//         }
//     })
// }

$(document).ready(function(){
	// loadAddGuestPopup();
	// venues = [];
	// events = [];
	// calendar = new Calendar("#calendar");
	// venueList = new VenueListPanel('#venueList')
 //    eventList = new EventList("#eventList") 
 	app = new Vue({
 		el : "#managerPage",
 		data : {
 			venues : [],
 			events : []
 		}
 	});

});

// function App() {
// 	this.vue = new Vue({
// 		el : '#app',
// 		data : {
// 			contacts : ["Phone", "Email"],
// 			events : [],
// 			venues : []
// 		}	
// 	}); 
// }
// function loadAddGuestPopup() {
// 	$.get('/eventos', function (res) {
		
// 		//render dropdown on event select
// 		$('#evento-input')
// 			.select2({
// 				placeholder : "Select an event",
// 				data : res
// 			})
// 			.val(null).trigger('change')				//Set value to placeholder (i.e. nothing is selected)
// 			.on('select2:select', onEventSelect);	//Define event to load emails of selected event and add to guest dropdown

// 		//Init guest dropdown as disabled
// 		guestSelect = $('#add-guests-modal #guests-list-input').select2({
// 			placeholder : "Enter guests email here",
// 			tags: true,
// 			tokenSeparators: [',', ' '],
// 			disabled : true,
// 		});	
// 	});
// }

// //moves any modals inside another modal outside the modal
// function moveStackedModals() {
// 	$("div.modal  div.modal").appendTo("#managerContainer");
// }

// function onEventSelect(e) {
// 	console.log(e);
	
// 	//Get the selected event's list of invited guests
// 	$.get('/eventos'/* /getguests */,
// 		{id : e.currentTarget.value}, 
// 		function (res) {
// 			console.log(res);
			
// 			//Test data for demo
// 			emails = [
// 				Math.random().toString(36).substring(7) + "@gmail.com",
// 				Math.random().toString(36).substring(7) + "@gmail.com",
// 				Math.random().toString(36).substring(7) + "@gmail.com",
// 				Math.random().toString(36).substring(7) + "@gmail.com",
// 				Math.random().toString(36).substring(7) + "@gmail.com",
// 				Math.random().toString(36).substring(7) + "@gmail.com"
// 			];

// 			//render dropdown with event emails as options
// 			guestSelect = $('#add-guests-modal #guests-list-input').select2({
// 				placeholder : "Enter guests' emails here",
// 				tags: true,
// 				tokenSeparators: [',', ' '],
// 				disabled : false,
// 				data : emails
// 			});
// 			//Add all the emails as the dropdown's selected options
// 			guestSelect.val(emails).trigger("change");
// 		}
// 	);
// }