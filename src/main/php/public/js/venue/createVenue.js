function ContactFormGroup(el, contacts) {
    this.vue = new Vue({
        el : el,
        data : {
            contacts : contacts
        }
    }); 
}

/* 
    Returns the contact data as a json_encoded object
*/
ContactFormGroup.prototype.getData = function() {
    var data = new Object();
    this.vue.contacts
        // filter out contact fields with empty values
        .filter(contact => $.inArray(contact.value, ['', null]) == -1)
        // Store contacts into a json object
        .forEach(function(contact) {
            data[contact.name] = contact.value;
        });
    return data;
}

function CreateVenueForm(el) {
    var that = this;
    this.el = $(el); 
    this.contactFormGroup = new ContactFormGroup("#contactsFormGroup", [
        {
            name : "Phone", 
            value : ''
        },
        {
            name : "Email",
            value : ''
        }
    ]);

    /* 
     Returns form data as a serialized array. Includes all the contacts in a 
     json object. 
    */
    this.getData = function() {
        var data = that.el.serializeArray();
        data.push({
            name : 'contacts', 
            value : JSON.stringify(that.contactFormGroup.getData())
        });
        return data;
    };

    configFormSubmitEvent(this.getData);
}



/**
 * Overwrites the default submit form event
 */
function configFormSubmitEvent(dataGenerator) {
    $('#createVenueForm').submit(function(e){
        e.preventDefault();

        if ($('#create-venue-modal').length)
            $('#create-venue-modal').modal('hide');

        $.post({
            url: '/createVenue',
            data : dataGenerator(),
            success : function(res){
                $('#alertPanel').append(
                        '<div id="event-alert-' + res.id + 
                        '" class="fade in alert alert-' + res.status + '">' + 
                        '<a href="#" class="close" ' + 
                        'data-dismiss="alert">&times;</a>' +
                        res.msg + 
                        '</div>'
                    );
                $('#event-alert-' + res.id).attr("tabindex",-1).focus();
                if(window.venueSelect)
                    window.venueSelect.selectVenueModel(res.venue);
                if(window.app.venues)
                    window.app.venues.push(res.venue);
            }
        }).fail(function(res){
            new ErrorAlert(res.responseJSON).focus();
        });

    });
}

function AlertMessage() {
    this.id = Date.now();
    this.panel = $("#alertPanel");
    this.el = "#evento-alert-" + this.id;
}

AlertMessage.prototype.focus = function() {
    $(this.el).attr("tabindex",-1).focus();
};

function ErrorAlert(errors) {
    AlertMessage.call(this);
    var errorMsg = '';
    if (typeof errors != 'object')
        errorMsg += 'Woops, we encountered a problem trying to create your event, ' + 
                    'if this error persists you can contact us at help@evento.com'
    else 
    {
        errorMsg += 'There were some errors in the venue submitted. Please change the following:</br><ul>';
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


$(document).ready(function() {
   createVenueForm = new CreateVenueForm("#createVenueForm");
});