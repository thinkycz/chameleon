<template>
    <div class="basket"
        :class="{'active': isVisible}">

        <div class="basket-wrapper">
            <div class="basket-wrapper__inner">
                <h4 class="py-4 text-white bg-primary px-4 uppercase text-sm">{{ $trans('header.your_basket') }}</h4>

                <ul class="basket-items">
                    <li v-for="item in basketItems"
                        :key="'basket-item-' + item.id">
                        <div class="flex justify-left items-center">
                            <div class="inline-block mr-4">
                                <img :src="item.product.thumb"
                                    :alt="item.name"
                                    class="rounded-img">
                            </div>
                            <div class="inline-block">
                                <span class="text-grey-dark">{{ item.quantity_ordered }}&times; <span class="text-grey-darkest">{{ item.name }}</span></span>
                                <p class="item-price">{{ item.formatted_price }}</p>
                            </div>
                        </div>
                        <button role="button"
                            class="item-remove">
                            <icon-closecircle></icon-closecircle>
                        </button>
                    </li>
                </ul>
                <div class="basket-total">
                    <span>{{ $trans('header.basket_total') }}</span>
                    <span>{{ total }}</span>
                </div>
                <div class="bg-primary w-full text-center py-6 mt-3">
                    <a href="/checkout"
                        class="font-bold text-white">{{ $trans('header.checkout') }}</a>
                </div>
                <div class="text-center mt-2">
                    <a href="/basket"
                        class="text-grey-darkest">{{ $trans('header.view_basket') }}</a>
                </div>
            </div>
        </div>

        <div class="basket-overlay"
            @click.stop="close"></div>

    </div>
</template>

<script>
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

        computed: {
            basketItems() {
                return this.$store.getters.getBasketItems;
            },

            total() {
                return this.$store.getters.getBasketTotal;
            },
        },

        methods: {
            toggle() {
                this.isVisible = !this.isVisible;
                document.body.classList.toggle('overflow-hidden');
                document.querySelector('header').classList.toggle('z-50');
            },

            close() {
                if (this.isVisible) {
                    this.isVisible = false;
                    document.body.classList.remove('overflow-hidden');
                    document.querySelector('header').classList.remove('z-50');
                }
            },

            updateStore(basket) {
                this.$store.commit('setBasketItems', basket.ordered_items);
                this.$store.commit('setBasketTotal', basket.formatted_total_price);
            },
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