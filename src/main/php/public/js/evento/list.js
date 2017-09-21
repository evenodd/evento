var eventList;
var listLoader;

$(document).ready(function() {
    // Disaply a loading prompt while requesting events
    listLoader = new Vue({
        el : "#list-loader",
        data : {
            loading : true,
            color : "grey"
        }
    })
    // Request the user's events
    $.get('/eventos', function (res) {
        //display the events
        eventList = new Vue({
            el : '#event-list',
            data : {
                events : res, 
            }
        }); 
        //hide the loader
        listLoader.loading = false;
    });

});