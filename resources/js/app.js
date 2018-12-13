/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./helpers');
require('./translations/translations');

window.Vue = require('vue');

/**
 * Dependencies
 */
import 'babel-polyfill';
import PortalVue from 'portal-vue';
import { store } from './store/store';

/**
 * Use dependencies
 */
Vue.use(PortalVue);

/**
 * Icons
 */
const icons = require.context('./icons', true, /\.vue$/i);
icons.keys().map(key => {
    let icon = key
        .split('/')
        .pop()
        .split('.')[0]
        .toLowerCase();
    Vue.component(`icon-${icon}`, icons(key));
});

/**
 * Elements
 */
const elements = require.context('./components/elements', true, /\.vue$/i);
elements.keys().map(key => {
    let component = key
        .split('/')
        .pop()
        .split('.')[0]
        .toLowerCase();
    Vue.component(`vue-${component}`, elements(key));
});

// Profile
Vue.component('vue-profile', require('./components/profiles/Profile.vue'));
Vue.component('vue-addresses', require('./components/profiles/Addresses.vue'));
Vue.component('vue-address-box', require('./components/profiles/AddressBox.vue'));
Vue.component('vue-orders', require('./components/profiles/Orders.vue'));
Vue.component('vue-order-box', require('./components/profiles/OrderBox.vue'));
Vue.component('vue-profile-chart', require('./components/profiles/Chart.vue'));
Vue.component('vue-dropdown-menu', require('./components/profiles/Dropdown.vue'));

// Basket
Vue.component('vue-basket', require('./components/basket/Basket.vue'));
Vue.component('vue-header-basket', require('./components/basket/HeaderBasket.vue'));

// Product
Vue.component('vue-product-gallery', require('./components/product/Gallery.vue'));

const app = new Vue({
    el: '#app',
    store,
});
