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
import PortalVue from 'portal-vue';

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

Vue.component('vue-profile', require('./components/profiles/Profile.vue'));
Vue.component('vue-addresses', require('./components/profiles/Addresses.vue'));
Vue.component('vue-address-box', require('./components/profiles/AddressBox.vue'));

const app = new Vue({
    el: '#app',
});
