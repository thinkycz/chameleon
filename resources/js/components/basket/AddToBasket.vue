<template>
    <div class="product-actions">
        <button type="button"
            class="btn btn-primary icon-wrap mx-auto uppercase text-xs"
            :class="{'mini': isMini}"
            :disabled="disabled"
            @click="handleButtonClicked">
            <component :is="icon"></component><span v-if="!isMini">{{ label }}</span>
        </button>
        <quantity :product="product"
            :quantity="quantity"
            @input="quantity = $event"></quantity>
    </div>
</template>

<script>
    import Quantity from './Quantity';

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
                this.disabled = true;

                /**
                 * Dont do anything if the quantity is 0
                 * and the product is not in the basket
                 */
                if (!this.isInBasket && !parseInt(this.quantity)) {
                    return;
                }

                axios
                    .post(`products/${this.product.id}/basket`, {
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

            updateStore(basket) {
                this.$store.commit('setBasketItems', basket.ordered_items);
                this.$store.commit('setBasketTotal', basket.formatted_total_price);
            },
        },

        components: {
            Quantity,
        },

        created() {
            this.quantity = this.isInBasket ? this.item.quantity_ordered : this.product.minimum_order_quantity;
        },
    };
</script>