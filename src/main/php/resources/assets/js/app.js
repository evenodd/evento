
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// yes lets use window cus fuk portability👍
window.Vue = require('vue');
window.moment = require('moment');
window.select2 = require('select2');
window.fullCalendar = require('fullCalendar');
window.stringHash = require('string-hash');
window.sprintf= require('sprintf-js').sprintf;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

//event components
Vue.component('event-row', require('./components/event/Row.vue'));
Vue.component('guest-badge', require('./components/event/GuestBadge.vue'));
Vue.component('event-list', require('./components/event/List.vue'));
Vue.component('event-seats', require('./components/event/Seats.vue'));
Vue.component('event-seats-form', require('./components/event/SeatsForm.vue'));
Vue.component('event-form', require('./components/event/Form.vue'));

// venue components
Vue.component('venue-form', require('./components/venue/Form.vue'));
Vue.component('contact-inputs', require('./components/venue/ContactInputs.vue'));
Vue.component('venue-row', require('./components/venue/Row.vue'));
Vue.component('venue-list', require('./components/venue/List.vue'));
Vue.component('venue-display', require('./components/venue/Display.vue'));


//open source components 
Vue.component('pacman-loader', require('vue-spinner/src/PacmanLoader.vue'));
Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue'));
Vue.component('full-loader', require('vue-full-loading'));

Vue.component('calendar', require('./components/calendar/Calendar.vue'));
Vue.component('full-calendar', require('vue-fullcalendar'));

Vue.component('rsvp-list', require('./components/rsvp/Row.vue'));

// define some global date formats to use
Vue.filter('shortDate',  function (date) {
	return moment(date, "YYYY-MM-DD hh:mm:ss").format("Do MMM hh:mm a");
});
Vue.filter('longDate', function (date) {
	return moment(date, "YYYY-MM-DD hh:mm:ss").format("Do, MMMM YYYY hh:mm a");
});

// const app = new Vue({
//     el: '#app'
// });
