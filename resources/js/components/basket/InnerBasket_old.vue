<template>
    <div class="inner-basket">
        <div class="py-3 px-4 bg-success-lighter border-l-2 border-success-darker">
            <p class="mb-0 text-success-darker">{{ $trans('header.you_can_view_ordered_items') }}</p>
        </div>

        <ul class="basket-items border-b">
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
                class="btn-text btn-primary">{{ $trans('header.view_basket') }}</a>
        </div>
    </div>
</template>

<script>
    import SidebasketItemQuantity from './SidebasketItemQuantity';
    import { BasketMixin } from './../../mixins/basket';

    export default {
        computed: {
            total() {
                return this.$store.getters.getBasketTotal;
            },
        },

        methods: {
            update(payload) {
                axios
                    .post(`/ordered-items/${payload.item}/update`, {
                        quantity: payload.quantity,
                    })
                    .then(({ data }) => {
                        this.updateStore(data.payload.basket);
                        this.$toasted.success($trans('basket.successfully_updated'));
                    })
                    .catch(({ response }) => {
                        this.$toasted.error(response.data.message);
                    });
            },

            remove(id) {
                axios
                    .delete(`/ordered-items/${id}/remove`)
                    .then(({ data }) => {
                        this.updateStore(data.payload.basket);
                        this.$toasted.success($trans('basket.successfully_deleted'));
                    })
                    .catch(({ response }) => {
                        this.$toasted.error(response.data.message);
                    });
            },
        },

        components: {
            SidebasketItemQuantity,
        },

        mixins: [BasketMixin],
    };
</script>