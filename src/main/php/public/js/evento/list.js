function EventList(el){
    this.vue = new Vue({
        el : el,
        data : {
        	events : []
        }
    })
}

$(document).ready(function() {
   eventList = new EventList("#eventList") 
});