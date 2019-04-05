import Vue from 'vue';
import 'babel-polyfill';
import PortalVue from 'portal-vue';
import { store } from './store/store';
import * as vMediaQuery from 'v-media-query';

require('./bootstrap');
require('./helpers');
require('./translations/translations');
require('./common');
require('lightbox2');

/**
 * Use media queries
 */
Vue.use(vMediaQuery.default);

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

// Base
Vue.component('vue-base-dropdown', require('./components/base/Dropdown.vue'));

// Profile
Vue.component('vue-profile', require('./components/profiles/Profile.vue'));
Vue.component('vue-addresses', require('./components/profiles/Addresses.vue'));
Vue.component('vue-address-box', require('./components/profiles/AddressBox.vue'));
Vue.component('vue-orders', require('./components/profiles/Orders.vue'));
Vue.component('vue-order-box', require('./components/profiles/OrderBox.vue'));
Vue.component('vue-profile-chart', require('./components/profiles/Chart.vue'));

// Fields
Vue.component('vue-company-id', require('./components/fields/CompanyId.vue'));

// Basket
Vue.component('vue-basket', require('./components/basket/Basket.vue'));
Vue.component('vue-header-basket', require('./components/basket/HeaderBasket.vue'));
Vue.component('vue-add-to-basket', require('./components/basket/AddToBasket.vue'));
Vue.component('vue-basket-item-quantity', require('./components/basket/ItemQuantity.vue'));

// Product
Vue.component('vue-product-gallery', require('./components/product/Gallery.vue')); // Dynamically
Vue.component('vue-price-filter', require('./components/product/PriceFilter.vue'));

// Search
Vue.component('vue-search', require('./components/search/Search.vue'));

// Checkout
Vue.component('vue-checkout-steps', require('./components/checkout/CheckoutSteps.vue'));
Vue.component('vue-checkout-address-wrapper', require('./components/checkout/AddressWrapper.vue'));
Vue.component('vue-checkout-address-selector', require('./components/checkout/AddressSelector.vue'));
Vue.component('vue-checkout-address-form', require('./components/checkout/AddressForm.vue'));
Vue.component('vue-checkout-shipping-details', require('./components/checkout/ShippingDetails.vue'));
Vue.component('vue-checkout-delivery-payment', require('./components/checkout/DeliveryPayment.vue'));

// Dropdowns
Vue.component('vue-per-page', require('./components/dropdowns/PerPage.vue'));
Vue.component('vue-sort-products', require('./components/dropdowns/SortProducts.vue'));
Vue.component('vue-dropdown', require('./components/dropdowns/Dropdown.vue'));
Vue.component('vue-tags-dropdown', require('./components/dropdowns/Tags.vue'));
Vue.component('vue-subcategories-dropdown', require('./components/dropdowns/Subcategories.vue'));
Vue.component('vue-languages', require('./components/dropdowns/Languages.vue'));
Vue.component('vue-currencies', require('./components/dropdowns/Currencies.vue'));

const app = new Vue({
    el: '#app',
    store,
});
