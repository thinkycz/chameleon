<template>
    <div class="header-cart">
        <icon-cart></icon-cart>
        <span class="cart-total">{{ total }}</span>
    </div>
</template>

<script>
    export default {
        computed: {
            total() {
                return this.$store.getters.getBasketItems.length;
            },
        },
    };
</script>