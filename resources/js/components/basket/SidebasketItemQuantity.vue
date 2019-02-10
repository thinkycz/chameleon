<template>
    <div class="basket-item-quantity flex items-center">
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
        <div class="ml-3 text-center">
            <span class="text-accent mb-2 block w-4 text-center relative"
                style="left: -4px;"
                @click="update">
                <icon-sync></icon-sync>
            </span>
            <span class="text-danger block w-4 text-center icon-smaller"
                @click="remove">
                <icon-trash></icon-trash>
            </span>
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