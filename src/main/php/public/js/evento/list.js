var eventList;

$(document).ready(function() {
    // Create the event list component
    const listLoader = new Vue({
        el : "#list-loader",
        data : {
            loading : true,
            color : "grey"
        }
    })
    // Request the user's events
    $.get('/eventos', function (res) {
        console.log(res);
        eventList = new Vue({
            el : '#event-list',
            data : {
                events : res, 
            }
        }); 
        listLoader.loading = false;
    });

});