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
        },

        data: () => ({
            options: [
                {
                    value: 'relevance',
                    label: trans('filters.relevance'),
                },
                {
                    value: 'alphabetically',
                    label: trans('filters.alphabetically'),
                },
            ],
        }),

        created() {
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
    };
</script>
