
/**
 * Returns the value of any items with the specified name.
 * 
 * @param arr  the serialized array 
 * @param name the name to find
 * @return an array of values
 */
function serializedArray_getDuplicates(arr, name) {
    return arr
            .filter(function(e) {
                return e.name == name;
            })
            .map(function(e) {
                return e.value;
            });
}



$(document).ready(function() {
   alert("hello world");
   initFormSubmitEvent();
});

/**
 * Overwrites the default submit form event
 */
function initFormSubmitEvent() {
    $('#createVenueForm').submit(function(e){
        e.preventDefault();

        formData = $('#createVenueForm').serializeArray();
        //venueName = serializedArray_getDuplicates(input, 'venueName');
        //description = serializedArray_getDuplicates(input, 'description');
        //addressNumber = serializedArray_getDuplicates(input,'address-number');
        //streetName = serializedArray_getDuplicates(input,'street-name');
        //city = serializedArray_getDuplicates(input,'city');
        //state = serializedArray_getDuplicates(input,'state');
        //postcode = serializedArray_getDuplicates(input,'postcode');
        //country = serializedArray_getDuplicates(input,'country');
        //maxCapacity = serializedArray_getDuplicates(input,'max-capacity');
        //alert( venueName);
        //alert( description);
        //alert(addressNumber );
        //alert(streetName );
        //alert(city );
        //alert(state );
        //alert(postcode );
        //alert(country );
        //alert(maxCapacity); 
        //return formData;
        $.post({
            url: '/createVenue',
            data : formData,
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
            alert("oh shit");
        });

    });
}