<template>
    <div class="inner-basket">
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
                        <p class="p-big text-left text-sm">
                            <a :href="item.product.show_path"
                                class="text-grey-darkest">{{ item.name }}</a>
                        </p>
                        <p class="p-small text-left">
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
        <div class="text-center py-3 border-t mt-3 mx-2">
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
                        this.$toasted.success(this.$trans('basket.successfully_updated'));
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
                        this.$toasted.success(this.$trans('basket.successfully_deleted'));
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