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
            document.querySelector(this.toggler).addEventListener('click', this.toggle);
        },

        destroyed() {
            document.querySelector(this.toggler).removeEventListener('click', this.toggle);
        },

        components: {
            SidebasketItemQuantity,
        },
    };
</script>