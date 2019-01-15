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
        <p class="mb-0 text-xs text-center cursor-pointer">
            <span class="text-accent mr-2"
                @click="update">{{ $trans('global.update') }}</span>
            <span class="text-danger"
                @click="remove">{{ $trans('global.delete') }}</span>
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

            remove() {
                return this.$emit('remove', this.item.id);
            },

            update() {
                return this.$emit('update', {
                    item: this.item.id,
                    quantity: this.quantity,
                });
            },
        },
    };
</script>