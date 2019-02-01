<template>
    <vue-base-dropdown name="currency"
        :label="current"
        :page="false"
        :options="items">
    </vue-base-dropdown>
</template>

<script>
    export default {
        props: {
            current: {
                required: true,
            },

            currencies: {
                required: true,
            },
        },

        data: () => ({
            items: [],
        }),

        created() {
            this.items = this.currencies.map(currency => ({
                label: currency.name[window.currentLocale],
                value: currency.isocode,
            }));
        },
    };
</script>