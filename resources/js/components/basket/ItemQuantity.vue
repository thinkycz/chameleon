<template>
    <div class="basket-item-quantity">
        <div class="quantity mb-2">
            <input :name="`quantities[${item.id}]`"
                type="number"
                v-model="quantity"
                :min="item.product.minimal_order_quantity"
                :max="item.product.quantity_in_stock"
                step="1" />
            <div class="quantity-nav">
                <div class="increment"
                    @click.stop.prevent="increaseQuantity">+</div>
                <div class="decrement"
                    @click.stop.prevent="decreaseQuantity">-</div>
            </div>
        </div>
        <p class="text-danger text-xs text-center mb-0">
            <vue-button method="delete"
                :action="`/basket/ordered-items/${item.id}`"
                :confirm="true"
                :label="$trans('basket.delete_item')"
                button-class="btn-text btn-danger font-normal text-xs">
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