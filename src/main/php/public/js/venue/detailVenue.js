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
        errorMsg += 'Woops, we encountered a problem trying to cancel this venue, ' + 
                    'if this error persists you can contact us at evento.help@fourtytwo.com'
    else 
    {
        errorMsg += 'There were some problems when trying to cancel this venue:</br><ul>';
        $.each(errors, function(key, error) {
            errorMsg += '<li>' + error + '</li>';
        });
        errorMsg += '</ul>';
    }

    this.panel.append(
        '<div id="venue-alert-' + this.id + '" class="fade in alert alert-warning">' +
            '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
            errorMsg + 
        '</div>'
    );
    return this;
}
ErrorAlert.prototype = Object.create(AlertMessage.prototype);
ErrorAlert.prototype.constructor = ErrorAlert;

function SuccessAlert(msg) {
    AlertMessage.call(this);
    this.panel.append(
        '<div id="venue-alert-' + this.id + '" class="fade in alert alert-success">' + 
        '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
        msg + 
        '</div>'
    );
}
SuccessAlert.prototype = Object.create(AlertMessage.prototype);
SuccessAlert.prototype.constructor = SuccessAlert;


function EventList(el) {
	this.vue = new Vue({
		el : el
	});
}

function CancelVenueForm(el, venue) {
	this.el = el;
	this.venue = venue;
	//bind functions to current scope
	this.submitHandler  = this.submitHandler.bind(this);
	this.successHandler = this.successHandler.bind(this);
	this.failHandler    = this.failHandler.bind(this);
	
	el.submit(this.submitHandler);
}

CancelVenueForm.prototype.submitHandler = function(e) {
	e.preventDefault();
	var that = this;
	$.post({
		url : '/venue/cancel/' + this.venue.id,
		data : {
			_token : $("meta[name='csrf-token']").attr("content")
		},
		success : that.successHandler
	}).fail(that.failHandler);
};

CancelVenueForm.prototype.successHandler = function(res) {
	window.location.reload();
};

CancelVenueForm.prototype.failHandler = function(errors) {
	new ErrorAlert(errors.responseJSON).focus();
};

$(document).ready(function() {
	var venue = $("#venue-details").data('venue')
	cancelVenueForm = new CancelVenueForm($('#cancelVenue'), venue);
	eventList = new EventList('#eventList');
});