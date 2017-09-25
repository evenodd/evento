var eventList;
var listLoader;

$(document).ready(function() {
    // Disaply a loading prompt while requesting events
    listLoader = new Vue({
        el : "#list-loader",
        data : {
            loading : true,
            color : "grey",
            size : '30px'
        }
    })
    // Request the user's events
    $.get('/eventos', function (res) {
        //display the events
        eventList = new Vue({
            el : '#event-list',
            data : {
                events : res,
                show_guests : true 
            }
        }); 
        //hide the loader
        listLoader.loading = false;
    });

});