import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        basketItems: [],
        basketTotal: 0,
    },
    getters: {
        getBasketItems: state => state.basketItems,
        getBasketTotal: state => (state.basketTotal ? state.basketTotal : ''),
    },
    mutations: {
        setBasketItems: (state, basketItems) => {
            state.basketItems = basketItems;
        },
        setBasketTotal: (state, total) => {
            state.basketTotal = total;
        },
    },
});
