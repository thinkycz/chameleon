<template>
    <div class="basket"
        :class="{'active': isVisible}"
        v-if="!isDisabled">

        <div class="basket-wrapper">
            <div class="basket-wrapper__inner">

                <div class="p-4 relative">
                    <button role="button"
                        @click="close"
                        class="text-3xl absolute text-grey-dark"
                        style="left: 12px; top: 6px;"><span>&times;</span></button>
                    <h4 class="font-normal text-lg text-center">
                        {{ $trans('header.your_basket') }}
                    </h4>
                </div>

                <div class="py-3 px-4 bg-success-lighter border-l-2 border-success-darker">
                    <p class="mb-0 text-success-darker">{{ $trans('header.you_can_view_ordered_items') }}</p>
                </div>

                <ul class="basket-items">
                    <li v-for="item in basketItems"
                        :key="'basket-item-' + item.id">
                        <div class="flex justify-left items-center">
                            <div class="inline-block mr-4">
                                <img :src="item.product.thumb"
                                    :alt="item.name"
                                    class="rounded-lg-img">
                            </div>
                            <div class="inline-block mr-4 w-1/2">
                                <p class="p-big">{{ item.name }}</p>
                                <p class="p-small">
                                    <span class="mr-4">{{ item.quantity_ordered }}&times;<strong>{{ item.formatted_price }}</strong></span>
                                    <span>{{ $trans('basket.total') }}&nbsp;<strong class="text-primary">{{ item.formatted_total_price }}</strong></span>
                                </p>
                            </div>
                            <div class="inline-block w-1/3">
                                <sidebasket-item-quantity :item="item"
                                    @update="update($event)"
                                    @remove="remove($event)"></sidebasket-item-quantity>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="basket-total"
                    v-if="basketItems.length > 0">
                    <span>{{ $trans('header.basket_total') }}</span>
                    <span>{{ total }}</span>
                </div>
                <div v-else>
                    <p class="text-center">{{ $trans('header.add_products_basket_empty') }}</p>
                </div>

                <div class="w-full text-center pb-4 mt-3">
                    <a href="/checkout"
                        class="btn btn-primary mr-4">{{ $trans('header.checkout') }}</a>
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
    import SidebasketItemQuantity from './SidebasketItemQuantity';

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

            update(payload) {
                axios
                    .post(`ordered-items/${payload.item}/update`, {
                        quantity: payload.quantity,
                    })
                    .then(({ data }) => {
                        this.updateStore(data.payload.basket);
                        this.$toasted.show($trans('basket.successfully_updated'), {
                            type: 'success',
                        });
                    })
                    .catch(({ response }) => {
                        this.$toasted.show(response.data.message, {
                            type: 'error',
                        });
                    });
            },

            remove(id) {
                axios
                    .delete(`ordered-items/${id}/remove`)
                    .then(({ data }) => {
                        this.updateStore(data.payload.basket);
                        this.$toasted.show($trans('basket.successfully_deleted'), {
                            type: 'success',
                        });
                    })
                    .catch(({ response }) => {
                        this.$toasted.show(response.data.message, {
                            type: 'error',
                        });
                    });
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
            SidebasketItemQuantity,
        },
    };
</script>