<template>
    <vue-filterdropdown name="sort"
        :label="this.options[0].label"
        :options="options">
    </vue-filterdropdown>
</template>

<script>
    export default {
        props: {
            authenticated: {
                required: true,
            },

            newest: {
                required: false,
                default: false,
            },
        },

        data: () => ({
            options: [
                {
                    value: 'alphabetically',
                    label: trans('filters.alphabetically'),
                },
                {
                    value: 'relevance',
                    label: trans('filters.relevance'),
                },
            ],
        }),

        methods: {
            mergePrices() {
                this.options = this.authenticated
                    ? this.options.concat([
                          {
                              value: 'price_desc',
                              label: trans('filters.order_by_price_desc'),
                          },
                          {
                              value: 'price_asc',
                              label: trans('filters.order_by_price_asc'),
                          },
                      ])
                    : this.options;
            },

            mergeNewest() {
                this.options = this.newest
                    ? this.options.concat([
                          {
                              value: 'newest',
                              label: trans('filters.newest'),
                          },
                      ])
                    : this.options;
            },
        },

        created() {
            this.mergeNewest();
            this.mergePrices();
        },
    };
</script>
