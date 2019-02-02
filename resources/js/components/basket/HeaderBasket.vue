<template>
    <div class="header-cart">
        <span @click="toggle">
            <icon-cart></icon-cart>
            <span class="cart-total">{{ basketItems.length }}</span>
        </span>

        <div class="basket"
            :class="{'active': isVisible}"
            v-if="!isDisabled">
            <icon-dropdown></icon-dropdown>

            <div class="basker-inner">
                <div class="basket-header">
                    <span class="font-semibold">
                        <span @click="close" class="cursor-pointer mr-2 text-xl">&times;</span>
                        <a href="/basket" class="btn-text uppercase text-grey-darker">{{ $trans('header.your_basket') }}</a>
                    </span>
                    <span v-if="basketItems.length"
                        class="text-grey-dark">
                        {{ $trans('header.basket_total') }}&nbsp;<span class="text-primary font-semibold">{{ total }}&nbsp;{{ $trans('basket.incl_vat') }}</span>
                    </span>
                </div>

                <inner-basket v-if="basketItems.length"></inner-basket>
                <empty-basket v-else></empty-basket>

            </div>

            <div class="basket-overlay"
                @click.stop="close"></div>
        </div>
    </div>
</template>

<script>
    import EmptyBasket from './EmptyBasket';
    import InnerBasket from './InnerBasket';
    import vClickOutside from 'v-click-outside';
    import { BasketMixin } from './../../mixins/basket';
    import { mapGetters } from 'vuex';

    export default {
        props: {
            basket: {
                required: true,
            },

            isDisabled: {
                required: true,
                default: false,
            },
        },

        data: () => ({
            isVisible: false,
        }),

        computed: {
            ...mapGetters({
                basketItems: 'getBasketItems',
                total: 'getBasketTotal',
            }),
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
        },

        created() {
            this.updateStore(this.basket);
        },

        components: {
            EmptyBasket,
            InnerBasket,
        },

        directives: {
            clickOutside: vClickOutside.directive,
        },

        mixins: [BasketMixin],
    };
</script>