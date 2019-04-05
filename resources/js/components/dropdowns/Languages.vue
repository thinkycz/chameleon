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
                return window.currentLocale in this.locales ? this.locales[window.currentLocale] : this.locales[window.fallbackLocale];
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