
function AlertMessage() {
    this.id = Date.now();
    this.panel = $("#alertPanel");
    this.el = "#venue-alert-" + this.id;
}

AlertMessage.prototype.focus = function() {
    $(this.el).attr("tabindex",-1).focus();
};

function ErrorAlert(errors) {
    AlertMessage.call(this);
    var errorMsg = '';
    if (typeof errors != 'object')
        errorMsg += 'Woops, we encountered a problem trying to update your venue, ' + 
                    'if this error persists you can contact us at evento.help@fourtytwo.com'
    else 
    {
        errorMsg += 'There were some errors when updating the venue. Please change the following:</br><ul>';
        $.each(errors, function(key, error) {
            errorMsg += '<li>' + error + '</li>';
        });
        errorMsg += '</ul>';
    }

    this.panel.append(
        '<div id="evento-alert-' + this.id + '" class="fade in alert alert-warning">' +
            '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
            errorMsg + 
        '</div>'
    );
    return this;
}

function UpdateVenueForm(el, venue) {
    this.vue = new Vue({
        el : el,
        data : {
            venue : venue,
            token : $("meta[name='csrf-token']").attr("content")
        },
        methods : {
        	showError : function(errors) {
        		new ErrorAlert(errors.responseJSON).focus();
        	}
        }
    });
}
ErrorAlert.prototype = Object.create(AlertMessage.prototype);
ErrorAlert.prototype.constructor = ErrorAlert;

$(document).ready(function() {
    venue = $("#venueData").data("venue");
    updateVenueForm = new UpdateVenueForm("#updateVenueForm", venue);
});