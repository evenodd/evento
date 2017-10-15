function AlertMessage() {
    this.id = Date.now();
    this.panel = $("#alertPanel");
    this.el = "#rsvp-alert-" + this.id;
}

AlertMessage.prototype.focus = function() {
    $(this.el).attr("tabindex",-1).focus();
};

function ErrorAlert(errors) {
    AlertMessage.call(this);
    var errorMsg = '';
    if (typeof errors != 'object')
        errorMsg += 'Woops, we encountered a problem trying to rsvp this event, ' + 
                    'if this error persists you can contact us at evento.help@fourtytwo.com'
    else 
    {
        errorMsg += 'There were some errors registering to this event:</br><ul>';
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
ErrorAlert.prototype = Object.create(AlertMessage.prototype);
ErrorAlert.prototype.constructor = ErrorAlert;

function SuccessAlert(msg) {
    AlertMessage.call(this);
    this.panel.append(
        '<div id="evento-alert-' + this.id + '" class="fade in alert alert-success">' + 
        '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
        msg + 
        '</div>'
    );
}
SuccessAlert.prototype = Object.create(AlertMessage.prototype);
SuccessAlert.prototype.constructor = SuccessAlert;

function RsvpForm(el, event, rsvp) {
    this.vue = new Vue({
        el : el,
        data : {
        	rsvp : {
        		event : event.id,
                id : rsvp.id,
                email : rsvp.email,
                email_token : rsvp.email_token,
        		preferences : {
        			accepted : 1,
                    seats : null
        		},
        	},
            event : event
        },
        created : function() {
        	this.onSubmit = this.postRsvp;
        },
        methods : {
        	postRsvp : function(e) {
        		// var that = this;
                $.post({
        			url : '/storeRsvpResponse/' + this.rsvp.email_token,
                    data : {
                        _token : $("meta[name='csrf-token']").attr("content"),
                        rsvp : this.rsvp,
                    },
                    success : this.successCallback  
        		}).fail(this.failCallback);
        	},
            successCallback : function(res) {
                window.location.assign('/rsvpSuccess')
            },
            failCallback : function(errors) {
                new ErrorAlert(errors.responseJSON).focus(); 
            },
            onSubmit : () => {}
        }
    });
}

$(document).ready(function() {
    event = $("#eventData").data("event");
    rsvp = $("#rsvpData").data("rsvp");
    rsvpForm = new RsvpForm("#sendRSVP", event, rsvp);
});