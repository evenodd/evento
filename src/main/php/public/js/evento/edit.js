
function AlertMessage() {
    this.id = Date.now();
    this.panel = $("#alertPanel");
    this.el = "#event-alert-" + this.id;
}

AlertMessage.prototype.focus = function() {
    $(this.el).attr("tabindex",-1).focus();
};

function ErrorAlert(errors) {
    AlertMessage.call(this);
    var errorMsg = '';
    if (typeof errors != 'object')
        errorMsg += 'Woops, we encountered a problem trying to update your event, ' + 
                    'if this error persists you can contact us at evento.help@fourtytwo.com'
    else 
    {
        errorMsg += 'There were some errors when updating the event. Please change the following:</br><ul>';
        $.each(errors, function(key, error) {
            errorMsg += '<li>' + error + '</li>';
        });
        errorMsg += '</ul>';
    }

    this.panel.append(
        '<div id="event-alert-' + this.id + '" class="fade in alert alert-warning">' +
            '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
            errorMsg + 
        '</div>'
    );
    return this;
}
ErrorAlert.prototype = Object.create(AlertMessage.prototype);
ErrorAlert.prototype.constructor = ErrorAlert;

function UpdateEventForm(el, event) {
    this.vue = new Vue({
        el : el,
        data : {
            event : event,
            token : $("meta[name='csrf-token']").attr("content")
        },
        methods : {
            showError : function(errors) {
                new ErrorAlert(errors.responseJSON).focus();
            }
        }
    });
}

$(document).ready(function() {
    event = $("#eventData").data("event");
    updateEventForm = new UpdateEventForm("#eventForm", event);
});