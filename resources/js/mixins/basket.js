export const BasketMixin = {
    computed: {
        basketItems: function() {
            return this.$store.getters.getBasketItems;
        },
    },

    methods: {
        updateStore: function(basket) {
            this.$store.commit('setBasketItems', basket.ordered_items);
            this.$store.commit('setBasketTotal', basket.formatted_total_price);
        },
    },
};
