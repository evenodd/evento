$(document).ready(function(){
	$('#calendar').fullCalendar({
        header: {
        	right : 'month, agendaWeek, agendaDay, prev, today, next',
        	left : 'title' 
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
});