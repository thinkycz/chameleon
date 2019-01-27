<template>
    <vue-filterdropdown name="tags"
        :label="$trans('filters.tags')"
        :options="items">
    </vue-filterdropdown>
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
                label: tag.value,
                value: tag.id,
            }));
        },
    };
</script>
