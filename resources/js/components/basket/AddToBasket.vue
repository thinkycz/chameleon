<template>
    <div class="product-actions">
        <button type="button"
            class="btn btn-primary icon-wrap mx-auto uppercase text-xs"
            :class="{'mini': isMini}"
            :disabled="disabled"
            @click="handleButtonClicked">
            <component :is="icon"
                transition="fade"
                transition-mode="out-in"></component><span v-if="!isMini">{{ label }}</span>
        </button>
        <quantity :product="product"
            :quantity="quantity"
            @input="quantity = $event"></quantity>
    </div>
</template>

<script>
    import Quantity from './Quantity';
    import { BasketMixin } from './../../mixins/basket';

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
        },

        methods: {
            message(quantity) {
                // Deleted
                if (this.isInBasket && !quantity) {
                    return this.$trans('products.product_deleted');
                }

                // Updated
                if (this.isInBasket && quantity) {
                    return this.$trans('products.quantity_updated');
                }

                // Created
                if (!this.isInBasket && quantity) {
                    return this.$trans('products.added_to_basket');
                }
            },

            handleButtonClicked() {
                let quantity = parseInt(this.quantity);

                if (!this.isInBasket && !quantity) {
                    return this.$snack(this.$trans('products.increase_the_quantity'), 'info');
                }

                let message = this.message(quantity);
                this.disabled = true;
                axios
                    .post(`/products/${this.product.id}/basket`, {
                        quantity: this.quantity,
                    })
                    .then(({ data }) => {
                        this.updateStore(data.payload.basket);
                    })
                    .catch(({ response }) => {
                        this.$toasted.error(response.data.message);
                    })
                    .then(() => {
                        this.disabled = false;
                        this.$toasted.success(message);
                    });
            },
        },

        components: {
            Quantity,
        },

        created() {
            this.quantity = this.isInBasket ? this.item.quantity_ordered : this.product.minimum_order_quantity;
        },

        mixins: [BasketMixin],
    };
</script>