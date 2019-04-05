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
                        <product v-for="(product, index) in products"
                            :key="'product-' + index"
                            :product="product"
                            :additionalStyle="appendStyle(index)"></product>
                    </transition-group>
                </template>
            </transition>
        </div>
    </div>
</template>

<script>
    import Product from './Product';
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
                    this.products = data;
                });
            }, 1000),

            appendStyle(index) {
                if (index == this.products.length - 1 || index == this.products.length - 2) {
                    return {
                        marginBottom: 0,
                    };
                }
            },
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

        components: {
            Product,
        },
    };
</script>