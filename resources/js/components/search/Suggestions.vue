<template>
    <div class="search-suggestions"
        :class="{'show': show}">
        <div class="search-items">
            <h3>{{ $trans('header.product_results') }}</h3>
            <transition mode="out-in"
                name="fade">
                <template v-if="!products.length > 0 && query.length > 0">
                    <p>{{ $trans('header.no_results_found') }}</p>
                </template>
                <template v-else>
                    <transition-group name="list"
                        tag="ul"
                        class="row">
                        <li v-for="(product, index) in products"
                            :key="'product-' + index"
                            :class="{'second-last': index == products.length - 2}"
                            class="list-item col-half">
                            <div class="image">
                                <img class="rounded-lg-img"
                                    :src="product.thumb"
                                    :alt="product.slug">
                            </div>
                            <div>
                                <h4>
                                    <a class="truncate"
                                        :href="product.show_path">{{ product.name }}</a>
                                </h4>
                                <p class="text-xs text-grey-darker mb-0">
                                    <span v-if="product.catalogue_number">{{ $trans('products.catalogue_number') }}<strong class="ml-1">{{ product.catalogue_number }}</strong></span>
                                    <span v-if="product.barcode">{{ $trans('products.barcode') }}<strong class="ml-1">{{ product.barcode }}</strong></span>
                                </p>
                                <p class="mb-0"
                                    v-if="(showPrices && product.formatted_price)">
                                    <span class="price mr-1 inline-block">{{ product.formatted_price }}</span>
                                </p>
                            </div>
                        </li>
                    </transition-group>
                </template>
            </transition>
        </div>
    </div>
</template>

<script>
    import { throttle } from 'lodash';

    export default {
        props: {
            showPrices: {
                required: true,
            },

            show: Boolean,

            query: String,
        },

        data() {
            return {
                products: [],
            };
        },

        methods: {
            getItems: throttle(function() {
                axios.get(`/ajax/search?query=${this.query}`).then(({ data }) => {
                    this.products = data.products;
                });
            }, 1000),
        },

        created() {
            if (this.query.length > 0) {
                this.getItems();
            }
        },

        watch: {
            query: function(newValue, oldValue) {
                if (newValue.length > 0) {
                    this.getItems();
                }
            },
        },
    };
</script>