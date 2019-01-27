<template>
    <vue-base-dropdown name="lang"
        :label="current"
        :page="false"
        :options="items">
    </vue-base-dropdown>
</template>

<script>
    export default {
        props: {
            locales: {
                required: true,
            },
        },

        data: () => ({
            items: [],
        }),

        computed: {
            current() {
                return this.locales[window.currentLocale];
            },
        },

        created() {
            this.items = Object.keys(this.locales).map(key => ({
                label: this.locales[key],
                value: key,
            }));
        },
    };
</script>