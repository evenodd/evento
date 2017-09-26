
function ContactFormGroup(el, contacts) {
    this.vue = new Vue({
        el : el,
        data : {
            contacts : contacts
        }
    }); 
}

ContactFormGroup.prototype.getData = function() {
    var data = new Object();
    this.vue.contacts.forEach(function(contact) {
        data[contact] = $("#contactsFormGroup #" + stringHash(contact)).val();
    });
    return data;
}

function CreateVenueForm(el) {
    var that = this;
    this.el = $(el); 
    this.contactFormGroup = new ContactFormGroup("#contactsFormGroup", ["Phone", "Email"]);

    // returns form data as a serialized array. Includes all the contacts in a json object.
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


$(document).ready(function() {
   createVenueForm = new CreateVenueForm("#createVenueForm");
});

/**
 * Overwrites the default submit form event
 */
function configFormSubmitEvent(dataGenerator) {
    $('#createVenueForm').submit(function(e){
        e.preventDefault();
        $.post({
            url: '/createVenue',
            data : dataGenerator(),
            success : function(res){
                $('#alertPanel').append(
                        '<div id="event-alert-' + res.id + '" class="fade in alert alert-' + res.status + '">' + 
                        '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
                        res.msg + 
                        '</div>'
                    );
                $('#event-alert-' + res.id).attr("tabindex",-1).focus();
            }
        }).fail(function(res){
            id = Date.now();
            $('#alertPanel').append(
                '<div id="event-alert-' + id + '" class="fade in alert alert-warning">' +
                    '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
                    'There was an error creating your venue' + 
                '</div>'
            );
            $('#event-alert-' + id).attr("tabindex",-1).focus();
        });

    });
}