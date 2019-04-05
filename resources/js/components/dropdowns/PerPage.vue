<template>
    <vue-base-dropdown name="per_page"
        :label="defaultOption.label"
        :options="options">
    </vue-base-dropdown>
</template>

<script>
    export default {
        props: {
            defaultPagination: {
                required: false,
                default: 24,
            },
        },

        computed: {
            defaultOption() {
                return this.options.find(element => element.value === this.defaultPagination);
            },
        },

        data() {
            return {
                options: [
                    {
                        value: 12,
                        label: '12 ' + trans('filters.per_page'),
                    },
                    {
                        value: 24,
                        label: '24 ' + trans('filters.per_page'),
                    },
                    {
                        value: 36,
                        label: '36 ' + trans('filters.per_page'),
                    },
                    {
                        value: 48,
                        label: '48 ' + trans('filters.per_page'),
                    },
                    {
                        value: 96,
                        label: '96 ' + trans('filters.per_page'),
                    },
                ],
            };
        },
    };
</script>
