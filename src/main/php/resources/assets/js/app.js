
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('moment');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));
Vue.component('event-row', require('./components/event/Row.vue'));
Vue.component('event-list', require('./components/event/List.vue'));
Vue.component('pacman-loader', require('vue-spinner/src/PacmanLoader.vue'));
Vue.component('pulse-loader', require('vue-spinner/src/PulseLoader.vue'));


Vue.filter('shortDate',  function (date) {
	return moment(date, "YYYY-MM-DD hh:mm:ss").format("Do MMM hh:mm a");
});
Vue.filter('longDate', function (date) {
	return moment(date, "YYYY-MM-DD hh:mm:ss").format("Do, MMMM YYYY hh:mm a");
});

// const app = new Vue({
//     el: '#app'
// });
