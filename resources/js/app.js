
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.config.productionTip = false;
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('navbar', require('./components/navbar.vue'));
Vue.component('scrolltop', require('./components/scrolltop.vue'));
Vue.component('featuredDishes', require('./components/featuredDishes.vue'));
Vue.component('mainfooter', require('./components/mainfooter.vue'));
Vue.component('pizzas_menu', require('./components/pizzas_menu.vue'));
Vue.component('menuSubpage', require('./components/menuSubpage.vue'));
Vue.component('reservations', require('./components/reservation/reservations.vue'));
Vue.component('reservationModal', require('./components/reservation/reservationModal.vue'));
Vue.component('closed', require('./components/reservation/closed.vue'));
Vue.component('flashMessage', require('./components/flashMessage.vue'));
Vue.component('orderOnline', require('./components/order/orderOnline.vue'));
Vue.component('claim', require('./components/claim.vue'));

const app = new Vue({
    el: '#app'
});
