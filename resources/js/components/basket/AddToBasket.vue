<template>
    <button type="button"
        class="btn btn-primary icon-wrap mx-auto uppercase text-xs"
        :class="{'mini': isMini}"
        :disabled="disabled"
        @click="handleButtonClicked">
        <component :is="icon"></component><span>{{ label }}</span>
    </button>
</template>

<script>
    export default {
        props: {
            product: {
                required: true,
            },

            isMini: {
                required: false,
                default: true,
            },
        },

        data: () => ({
            quantity: null,
            disabled: false,
        }),

        computed: {
            icon() {
                return this.isInBasket ? 'icon-sync' : 'icon-cart';
            },

            label() {
                return this.isInBasket ? this.$trans('products.update_quantity') : this.$trans('products.add_to_basket');
            },

            item() {
                return this.basketItems.find(i => {
                    return i.product_id == this.product.id;
                });
            },

            isInBasket() {
                return typeof this.item !== 'undefined' ? true : false;
            },

            basketItems() {
                return this.$store.getters.getBasketItems;
            },
        },

        methods: {
            handleButtonClicked() {
                if (this.isInBasket) {
                    this.update();
                } else {
                    this.add();
                }
            },

            add() {
                this.disabled = true;

                axios
                    .post(`products/${this.product.id}/add-to-basket`, {
                        quantity: this.quantity,
                    })
                    .then(({ data }) => {
                        this.updateStore(data.payload.basket);
                    })
                    .catch(({ response }) => {
                        this.$toasted.show(response.data.message, {
                            type: 'error',
                        });
                    })
                    .then(() => {
                        this.disabled = false;
                    });
            },

            update() {
                //
            },

            remove() {
                //
            },

            updateStore(basket) {
                this.$store.commit('setBasketItems', basket.ordered_items);
                this.$store.commit('setBasketTotal', basket.formatted_total_price);
            },
        },

        created() {
            this.quantity = this.isInBasket ? this.item.quantity_ordered : this.product.minimum_order_quantity;
        },
    };
</script>