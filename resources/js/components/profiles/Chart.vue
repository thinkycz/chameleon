<template>
    <chart :currency="currency"
        height="60px"
        :labels="labels"
        :series="series" />
</template>

<script>
    import Chart from './../base/Chart.vue';

    export default {
        props: {
            currency: {
                required: true,
            },

            labels: {
                required: true,
            },

            series: {
                required: true,
            },
        },

        components: {
            Chart,
        },
    };
</script>