<template>
    <div class="search-suggestions"
        :class="{'show': show}">
        <div class="search-items">
            <h3>{{ $trans('header.search_products') }}</h3>
            <ul>
                <transition mode="out-in"
                    name="fade">
                    <template v-if="!items.length > 0 && query.length > 0">
                        <p>{{ $trans('header.no_results_found') }}</p>
                    </template>
                    <template v-else>
                        <transition-group name="list">
                            <li v-for="(item, index) in items"
                                :key="'item-' + index"
                                class="list-item">
                                <a class="image-wrapper"
                                    :href="item.show_path"><img class="rounded-img"
                                        :src="item.thumb"
                                        :alt="item.slug"></a>
                                <h4>
                                    <a class="nowrap"
                                        :href="item.show_path">{{ item.name }}</a>
                                </h4>
                                <span class="price mr-1"
                                    v-if="showPrices && item.formatted_price">{{ item.formatted_price }}</span>
                                <span class="type mr-1">{{ $trans('header.products') }}</span>
                                <span class="time">{{ item.formated_created_at }}</span>
                            </li>
                        </transition-group>
                    </template>
                </transition>
            </ul>
        </div>
        <div class="quick-links">
            <h3>{{ $trans('header.quick_links') }}</h3>
            <slot></slot>
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
                items: [],
            };
        },

        methods: {
            getItems: throttle(function() {
                axios.get(`ajax/search?query=${this.query}`).then(({ data }) => {
                    this.items = data.products;
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