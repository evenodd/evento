
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

//open source components 
Vue.component('pacman-loader', require('vue-spinner/src/PacmanLoader.vue'));
Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue'));

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
