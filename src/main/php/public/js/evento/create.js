function SerializedArray(serializedArray) {
    var that = this
    this.serializedArray = serializedArray;

    this.getArray = function () {
        return that.serializedArray;
    }
}

/**
 * Returns the serialized array with an index appended to the specified names.
 * 
 * E.g [{name : 'a', value : 1},{name : 'a', value : bar2}] ;
 *     becomes 
 *     [{name : 'a[0]', value : bar},{name : 'a[1]', value : bar2}] 
 *     when ['a'] is passed as a name
 *
 * @param arr   the serialized array 
 * @param names the names to index
 * @return an array of values
 */
SerializedArray.prototype.indexDuplicateNames = function(names) {
    var indexes = [];
    names.forEach(function(name) {
        indexes[name] = 0;
    });
    this.serializedArray.forEach(function(e) {
        // if the element's name is one of the names append an index an increment that name's index
        if (names.indexOf(e.name) != -1)
            e.name += '[' + (indexes[e.name]++) + ']';
    });

    return this;
}

function CreateEventForm(el) {
    var that = this;
    var maxGuestsBind = new CheckboxToInputBind('#max-guests-checkbox', "#max-guests");
    var priceBind = new CheckboxToInputBind('#price-checkbox', "#price");
    var rsvpBind = new CheckboxToInputBind('#rsvp-datetime-checkbox', "#rsvp-datetime");
    var seatsBind = new CheckboxToInputBind('#seats-checkbox', "#seats, #auto_pop_button");
    var hostBind = new CheckboxToInputBind('#host-checkbox', "#host-name, #host-email, #from-host-checkbox");
    var supplier = new SupplierSelect();
    var seats = new SeatSelect();
    var guests = new GuestSelect();

    this.onSubmit = function(e) {
        e.preventDefault();
        // Close any create event modals on the page
        if ($('#create-event-modal').length)
            $('#create-event-modal').modal('hide');

        that.postEvent(that.getData(), {
            success : function(res) {
                // add new event to list if defined
                if(window.app.events)
                    window.app.events.push(res.event);
                new SuccessAlert(res.msg).focus();
            },
            fail : function(res) {
                new ErrorAlert(res.responseJSON).focus();
            }
        });
    };

    this.el = $(el);
    this.el.submit(this.onSubmit);
}

CreateEventForm.prototype.getData = function() {
    return new SerializedArray(this.el.serializeArray()).indexDuplicateNames(['seats', 'guests-list']).getArray();
}


CreateEventForm.prototype.postEvent = function(data, callbacks) {
    $.post({
        url : '/eventos',
        data : data,
        success : callbacks.success,
    }).fail(callbacks.fail);
};

function CheckboxToInputBind(checkbox, input) {
    $(checkbox).change(function () {
        $(input).prop('disabled', !$(this).is(':checked'));
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
                    'if this error persists you can contact us at evento.help@fourtytwo.com'
    else 
    {
        errorMsg += 'There were some errors in the event submitted. Please change the following:</br><ul>';
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

function GuestSelect() {
    $('#createEventForm #guests-list').select2({
        placeholder : "Enter guests email here",
        tags: true,
        disabled: false,
        tokenSeparators: [',', ' '],
        width : '100%',
        data : [],
    });
}

function SeatSelect() {
    $('#seats').select2({
        placeholder : "Enter Seats (e.g 1,2,3,4,5...)",
        tags: true,
        tokenSeparators: [',', ' '],
        width : '100%',
        disabled : true
    });
    $("#auto_pop_button").click(function(e) {
        e.preventDefault();
        if ($("#max-guests").val() != null)
            var max = $("#max-guests").val();
        else 
            var max = 5;

        var array = [];

        for (var i=1; i<=max; i++) {
            array.push(i);
        }
        $('#seats').select2({
                placeholder : "Enter guests' seats here",
                tags: true,
                tokenSeparators: [',', ' '],
                disabled : false,
                data : array
            });
        $('#seats').val(array
           //insert array of 1 to max from venue
            ).trigger('change');
        
    });
}


function SupplierSelect() {
    $('#suppliers').select2({
        placeholder : "Add supplier...",
        data: [],
        width : '100%',
        /*
        
        ****Uncomment after supplier endpoint is done****

        data : $.get('/suppliers', function (res) {
            return res.suppliers.map(function (supplier) {
                return {id : supplier.id , text : supplier.name};
            });
        }),
        
        */
    });
}

function VenueSelect() {
     var that = this;
     this.el = $("#createEventForm #venue")
     this.el.select2({
        placeholder : "Loading venues..",
        width : '100%',
        data : []
    });

    this.setVenues = function(venues) {
        that.el.select2({
            placeholder : "Select a venue..",
            width : '100%',
            data : venues.map(that.venueDataTransform)
        });
    }

    this.getVenues({
        success : this.setVenues
    });
}

// Converts our venue model into a data object useable by select2
VenueSelect.prototype.venueDataTransform = function(venue) {
    return {id : venue.id , text : venue.name};
};

VenueSelect.prototype.getVenues = function(callbacks) {
    $.get({
        url : '/venues', 
        success : callbacks.success
    });   
};

VenueSelect.prototype.selectVenueModel = function(venue) {
    var option = new Option(venue.name, venue.id);
    option.selected = true;
    this.el.append(option);
    this.el.trigger('change');
};

$(document).ready(function() {
    createEventForm = new CreateEventForm("#createEventForm");
    venueSelect = new VenueSelect();
});