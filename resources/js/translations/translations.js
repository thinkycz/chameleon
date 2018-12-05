// Translations
import Vue from 'vue';
import vuexI18n from 'vuex-i18n';
import { store } from './../store/store';
import Locales from './locales.js';

Vue.use(vuexI18n.plugin, store);

Vue.i18n.add('en', Locales.en);

// set the start locale to use
Vue.i18n.set(window.currentLocale);
Vue.i18n.fallback(window.fallbackLocale);
Vue.prototype.$trans = window.trans = (key, payload) => Vue.i18n.translateIn(window.currentLocale, key, (payload = {}));
