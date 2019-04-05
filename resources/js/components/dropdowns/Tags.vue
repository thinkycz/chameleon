<template>
    <vue-base-dropdown name="tags"
        :label="$trans('filters.tags')"
        :options="items">
    </vue-base-dropdown>
</template>

<script>
    export default {
        props: {
            tags: {
                required: true,
            },
        },

        data: () => ({
            items: [],
        }),

        created() {
            this.items = this.tags.map(tag => ({
                label: tag.name[window.currentLocale],
                value: tag.id,
            }));
        },
    };
</script>
