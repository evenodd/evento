var eventList;
var listLoader;

function PublicEventListPanel() {
    // that refer
    var that = this;
    var loader = new Vue({
        el : "#publicEventLoader",
        data : {
            loading : true,
            color : "grey",
            size : '30px'
        }
    });
    var list = new Vue ({
        el : "#publicEventList",
        data : {
            events : [],
            show_guests : false
        }
    });
    var errorMessage = new Vue ({
        el :"#publicEventErrorMsg",
        data : {
            display : false,
            message : "Error could could not get data from server",
        }
    });

    this.getList = function() {
        return list;
    }

    this.setEvents = function(res) {
        list.events = res;
    }

    this.hideLoader = function(args) {
        loader.loading = false;
    }

    this.displayErrorMessage = function(error) {
        errorMessage.display = true;
    }

    // request data from server, storing it if successful
    this.getPublicEvents({
        success : this.setEvents,
        fail : this.displayErrorMessage,
        done : this.hideLoader
    });
}

PublicEventListPanel.prototype.getPublicEvents = function(callbacks) {
    $.get({
        url :'/eventos/public',
        success : callbacks.success,
    })
    .always(callbacks.done)
    .fail(callbacks.fail);
};

$(document).ready(function() {
    //render public event list
    publicEventListPanel = new PublicEventListPanel();
});