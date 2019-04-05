<template>
    <div class="inner-basket">
        <ul class="basket-items">
            <li v-for="item in basketItems"
                :key="'basket-item-' + item.id">
                <div class="flex justify-left items-center">
                    <div class="inline-block mr-4">
                        <img :src="item.product.thumbnail"
                            :alt="item.name"
                            class="rounded-lg-img">
                    </div>
                    <div class="inline-block mr-4 w-1/2">
                        <p class="p-big text-left text-sm">
                            <a :href="item.product.show_path"
                                class="text-grey-darkest">{{ item.name }}</a>
                        </p>
                        <div class="text-left text-xs">
                            <div class="my-1">
                                <span>{{ item.quantity_ordered }}&nbsp;&times;&nbsp;<strong>{{ item.formatted_price }}</strong></span>
                                <span class="ml-4">{{ $trans('basket.total') }}&nbsp;<strong class="text-primary">{{ item.formatted_total_price }}</strong></span>
                            </div>
                        </div>
                    </div>
                    <div class="inline-block w-1/3">
                        <sidebasket-item-quantity :item="item"
                            @update="update($event)"
                            @remove="remove($event)"></sidebasket-item-quantity>
                    </div>
                </div>
            </li>
        </ul>
        <div class="flex justify-between items-center p-5">
            <a href="/basket"
                class="btn-text btn-primary">{{ $trans('header.view_basket') }}</a>
            <a href="/checkout"
                class="btn btn-primary">{{ $trans('header.checkout') }}</a>
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