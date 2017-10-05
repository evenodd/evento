function VenueList(el){
    this.vue = new Vue({
        el : el,
        data : {
        	venues : []
        }
    })
}

$(document).ready(function() {
   venueList = new VenueList("#venueList") 
});