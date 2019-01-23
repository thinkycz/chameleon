<template>
    <div class="basket"
        :class="{'active': isVisible}"
        v-if="!isDisabled">

        <div class="basket-wrapper">
            <div class="basket-wrapper__inner">

                <div class="p-4 relative border-b">
                    <button role="button"
                        @click="close"
                        class="text-3xl absolute text-grey-dark"
                        style="left: 12px; top: 6px;"><span>&times;</span></button>
                    <h4 class="font-normal text-lg text-center">
                        {{ $trans('header.your_basket') }}
                    </h4>
                </div>

                <empty-basket v-if="!basketItems.length"></empty-basket>
                <inner-basket v-else></inner-basket>

            </div>
        </div>

        <div class="basket-overlay"
            @click.stop="close"></div>

    </div>
</template>

<script>
    import EmptyBasket from './EmptyBasket';
    import InnerBasket from './InnerBasket';
    import { BasketMixin } from './../../mixins/basket';

    export default {
        props: {
            toggler: {
                required: false,
                default: '.header-cart',
            },

            basket: {
                required: true,
            },

            isDisabled: {
                required: true,
                default: false,
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
        },

        created() {
            this.updateStore(this.basket);
        },

        mounted() {
            if (!this.isDisabled) {
                document.querySelector(this.toggler).addEventListener('click', this.toggle);
            }
        },

        destroyed() {
            if (!this.isDisabled) {
                document.querySelector(this.toggler).removeEventListener('click', this.toggle);
            }
        },

        components: {
            EmptyBasket,
            InnerBasket,
        },

        mixins: [BasketMixin],
    };
</script>