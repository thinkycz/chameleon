<template>
    <div class="quantity">
        <div class="overlay"
            v-if="!product.purchasable"></div>
        <input name="quantity"
            type="number"
            :min="product.minimal_order_quantity"
            :max="product.quantity_in_stock"
            :value="quantity"
            @change="handleQuantityUpdate($event)"
            step="1" />
        <div class="quantity-nav">
            <div class="increment"
                @click.stop.prevent="increaseQuantity">+</div>
            <div class="decrement"
                @click.stop.prevent="decreaseQuantity">-</div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            product: {
                required: true,
            },

            quantity: {
                required: true,
            },
        },

        methods: {
            increaseQuantity() {
                this.updateQuantity(
                    this.product.multiply_of_moq_only
                        ? this.quantity + this.product.minimum_order_quantity
                        : this.quantity + 1,
                );
            },

            decreaseQuantity() {
                if (this.product.multiply_of_moq_only) {
                    if (this.quantity - this.product.minimum_order_quantity >= this.product.minimum_order_quantity) {
                        return this.updateQuantity(this.quantity - this.product.minimum_order_quantity);
                    }
                    return this.updateQuantity(this.product.minimum_order_quantity);
                }
                return this.updateQuantity(this.quantity > 0 ? this.quantity - 1 : this.quantity);
            },

            handleQuantityUpdate(e) {
                let value = e.target.value;
                if (this.product.multiply_of_moq_only) {
                    if (this.quantity % this.product.minimum_order_quantity) {
                        return this.updateQuantity(value);
                    } else {
                        return (e.target.value = parseInt(this.quantity));
                    }
                }
                return this.updateQuantity(value);
            },

            updateQuantity(quantity) {
                this.$emit('input', quantity);
            },
        },
    };
</script>