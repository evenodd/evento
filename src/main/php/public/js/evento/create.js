
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
function serializedArray_indexDuplicates(arr, names) {
    //an array of indexes to index each name
    var indexes = [];
    names.forEach(function(name) {
        indexes[name] = 0;
    });

    arr.forEach(function(e) {
        // if the element's name is one of the names append an index an increment that name's index
        if (names.indexOf(e.name) != -1)
            e.name += '[' + (indexes[e.name]++) + ']';
    });

    return arr;
}

/**
 * Sets the specified checkbox element to toggle the disabled attribute of the specified input element.
 * 
 * @param checkbox a css selector for the checkbox element 
 * @param input    a css selector for the input element
 */
function initCheckboxEvent(checkbox, input) {
    $(checkbox).change(function () {
        $(input).prop('disabled', !$(this).is(':checked'));
    });
}

function initVenueSelect() {
    $("#createEventForm #venue").select2({
        placeholder : "Select a venue..",
        width : '100%',
        data : [{"id" : 1, "text" : "Jim's Venue"}],
        /*
        
        ****Uncomment after venue endpoint is done****

        data : $.get('/venues', function (res) {
            return res.venues.map(function (venue) {
                return {id : venue.id , text : venue.name};
            });
        }),
        
        */
    });
}

/**
 * Prepopulates the guest selection options with emails 'known' by the current user
 */
function initGuestSelect() {
    $('#createEventForm #guests-list').select2({
        placeholder : "Enter guests email here",
        tags: true,
        disabled: false,
        tokenSeparators: [',', ' '],
        width : '100%',
        data : [],
        /*
        Un-comment when user emails endpoint is done

        data : $.get('user/emails', function (res) {
            console.log(res);
            return res;
        }),
        */
    });

}

function initSupplierSelect() {
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

function initSeatsSelect() {
    $('#seats').select2({
        placeholder : "Enter Seats (e.g A1,A2,A3,A4,A5,B1...)",
        tags: true,
        tokenSeparators: [',', ' '],
        width : '100%',
        disabled : true
    });
}

function getCreateEventFormData() {
    //get all inputs from the form
    inputs = $('#createEventForm').serializeArray();
    
    return serializedArray_indexDuplicates(inputs, ['seats', 'guests-list'])

    // get arrays of all the seats and guests
    seats = serializedArray_getDuplicates(inputs, 'seats');
    guests = serializedArray_getDuplicates(inputs, 'guests-list');

    //filter out the seats and guests from the original inputs array
    inputs = inputs.filter(function(input) {
        return !['seats', 'guests-list'].includes(input.name)
    });

    // inputs = $('#createEventForm').serialize();

    //add the new seats & guests arrays back in the inputs array
    inputs.push(
        {'name' : 'seats[]', 'value' : seats},
        {'name' : 'guests-list[]', 'value' : guests}
    );
    console.log(inputs);

    return inputs;
}

function displayErrorAlert(errors) {
    id = Date.now();
    errorMsg = '';
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

    $('#alertPanel').append(
        '<div id="event-alert-' + id + '" class="fade in alert alert-warning">' +
            '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
            errorMsg + 
        '</div>'
    );
    $('#event-alert-' + id).attr("tabindex",-1).focus();
}

/**
 * Overwrites the default submit form event
 */
function initFormSubmitEvent() {
    $('#createEventForm').submit(function(e){
        e.preventDefault();

        // Close any create event modals on the page
        if ($('#create-event-modal').length)
            $('#create-event-modal').modal('hide');

        $.post({
            url : '/eventos',
            data : getCreateEventFormData(),
            //if successful, display an alert and focus on it
            success : function(res){
                if (res.status && res.msg) {
                    $('#alertPanel').append(
                        '<div id="event-alert-' + res.id + '" class="fade in alert alert-' + res.status + '">' + 
                        '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
                        res.msg + 
                        '</div>'
                    );
                    $('#event-alert-' + res.id).attr("tabindex",-1).focus();
                    if(eventList)
                        eventList.events.push(res.event);
                }
            },
        }).fail(function(res) {
            displayErrorAlert(res.responseJSON);
        });
    });
}

$(document).ready(function() {
    initGuestSelect();
    initSupplierSelect();
    initSeatsSelect();
    initVenueSelect();

    initFormSubmitEvent();

    //init checkbox events
    initCheckboxEvent('#max-guests-checkbox',    "#max-guests");
    initCheckboxEvent('#price-checkbox',         "#price");
    initCheckboxEvent('#rsvp-datetime-checkbox', "#rsvp-datetime");
    initCheckboxEvent('#seats-checkbox',         "#seats");
    initCheckboxEvent('#host-checkbox',          "#host-name, #host-email, #from-host-checkbox");
});