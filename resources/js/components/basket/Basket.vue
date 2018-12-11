<template>
    <div class="basket"
        v-click-outside="close">

    </div>
</template>

<script>
    import { ClickOutside } from './../../directives/ClickOutside';

    export default {
        props: {
            toggler: {
                required: false,
                default: '.header-cart',
            },

            basket: {
                required: true,
            },
        },

        data() {
            return {
                isVisible: false,
            };
        },

        methods: {
            toggle() {
                this.isVisible = !this.isVisible;
            },

            close() {
                if (this.isVisible) {
                    this.isVisible = false;
                }
            },

            updateStore(basket) {
                this.$store.commit('setBasketItems', basket.ordered_items);
                this.$store.commit('setBasketTotal', basket.formatted_total_price);
            },
        },

        directives: {
            ClickOutside,
        },

        created() {
            this.updateStore(this.basket);
        },

        mounted() {
            document.querySelector(this.toggler).addEventListener('click', this.toggle);
        },

        destroyed() {
            document.querySelector(this.toggler).removeEventListener('click', this.toggle);
        },
    };
</script>