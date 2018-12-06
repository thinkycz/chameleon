<template>
    <chart :currency="currency"
        height="60px" />
</template>

<script>
    import Chart from './../base/Chart.vue';

    export default {
        props: {
            currency: {
                required: true,
            },
        },

        components: {
            Chart,
        },
    };
</script>