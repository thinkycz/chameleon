<template>
    <vue-base-dropdown name="subcategory"
        :label="$trans('filters.subcategories')"
        :options="items">
    </vue-base-dropdown>
</template>

<script>
    export default {
        props: {
            subcategories: {
                required: true,
            },
        },

        data: () => ({
            items: [],
        }),

        methods: {
            recursive(category, prefix = '') {
                category.children.forEach(cat => {
                    this.recursive(cat, prefix + '— ');
                });

                this.items.push({
                    label: prefix + category.name[window.currentLocale],
                    value: category.id,
                });
            },
        },

        created() {
            this.subcategories.forEach(subcategory => {
                this.recursive(subcategory);
            });
        },
    };
</script>
