function EventList(el){
    this.vue = new Vue({
        el : el
    })
}

$(document).ready(function() {
   eventList = new EventList("#eventList") 
});