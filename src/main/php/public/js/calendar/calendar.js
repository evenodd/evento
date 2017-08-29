$(document).ready(function(){
	
	init_mainCalendar();
	
	$('#exitFullYear').on('click', 
		function() {
	        $('#calendar').toggle();
	        $('#fullYear').toggle();
	    }
    );

});

function init_mainCalendar() {
	$('#calendar').fullCalendar({
        header: {
        	right : 'fullYear, month, agendaWeek, agendaDay, prev, today, next',
        	left : 'title' 
        },

        customButtons: {
	        fullYear: {
	            text: 'Year',
	            click: function() {
	                $('#calendar').toggle();
	                $('#fullYear').toggle();
	                init_fullYearCalendars(
	                	$('#calendar').fullCalendar('getDate').format("YYYY"),
	                	$('#calendar').fullCalendar( 'clientEvents')
                	);
	            }
	        }
	    },

        // Test data for demo
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
        // eventSources: [{
        //     url: 'calendar/eventFeed', // use the `url` property
        // }],
    });
}

function init_fullYearCalendars(year, clientEvents) {
	for (i=1; i <= 12; i++) {		
		$('#calendar-' + i).fullCalendar({
			// Set date to the first day of the month in yyyy-mm-dd format
			defaultDate : year + "-" + moment(String(i), "M").format("MM", "M") + "-01",
			events : clientEvents,
			titleFormat : "MMMM", 
			header: {
	        	right : null,
	        	left : 'title' 
	        }
		});
	}
}