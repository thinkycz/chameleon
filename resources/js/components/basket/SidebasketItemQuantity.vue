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
        <div class="flex justify-end cursor-pointer">
            <span class="text-accent mx-2 icon-sm" @click="update"><icon-sync></icon-sync></span>
            <span class="text-danger mx-2 icon-sm" @click="remove"><icon-trash></icon-trash></span>
        </div>
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