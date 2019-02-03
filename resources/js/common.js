import Vue from 'vue';
import Toasted from 'vue-toasted';

Vue.prototype.$toasted = window.Toasted = Toasted;
Vue.prototype.$_ = window._ = require('lodash');
// Vue.prototype.$moment = window.moment = require('moment');

// moment.locale(window.currentLocale);

Vue.use(Toasted, {
    position: 'bottom-right',
    duration: 6000,
    theme: 'bubble',
});
