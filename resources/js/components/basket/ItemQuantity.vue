<template>
    <div class="basket-item-quantity">
        <div class="quantity mb-1">
            <input :name="`quantities[${item.id}]`"
                type="number"
                :class="{'border border-danger': hasError}"
                v-model="quantity"
                :min="item.product.minimal_order_quantity"
                :max="item.product.quantity_in_stock"
                step="1" />
            <div class="quantity-nav">
                <div class="increment"
                    :class="{'border-danger': hasError}"
                    @click.stop.prevent="increaseQuantity">+</div>
                <div class="decrement"
                    :class="{'border-danger': hasError}"
                    @click.stop.prevent="decreaseQuantity">-</div>
            </div>
        </div>
        <p class="text-xs text-right mb-0">
            <vue-button method="delete"
                :action="`/basket/ordered-items/${item.id}`"
                :confirm="true"
                :label="$trans('basket.delete_item')"
                button-class="btn-text text-grey-darker text-xs">
            </vue-button>
        </p>
    </div>
</template>

<script>
    export default {
        props: {
            item: {
                required: true,
            },

            hasError: {
                required: false,
                default: false,
            },
        },

        data() {
            return {
                quantity: this.item.quantity_ordered,
            };
        },

        methods: {
            increaseQuantity() {
                this.quantity = this.quantity + 1;
            },

            decreaseQuantity() {
                this.quantity = this.quantity > 1 ? this.quantity - 1 : 0;
            },
        },
    };
</script>