<template>
    <multistep-indicator :steps="steps"
        v-if="steps"></multistep-indicator>
</template>
<script>
    import MultistepIndicator from './../elements/MultistepIndicator';
    export default {
        props: {
            current: {
                required: true,
            },
        },

        data() {
            return {
                steps: null,
            };
        },

        created() {
            this.steps = [
                {
                    route: `${window.baseURL}/basket`,
                    visited: ['checkout', 'confirmation'].indexOf(this.current) !== -1,
                    current: this.current === 'basket',
                    label: 'basket.basket',
                    icon: 'icon-basket',
                },
                {
                    route: `${window.baseURL}/checkout`,
                    visited: ['confirmation'].indexOf(this.current) !== -1,
                    current: this.current === 'checkout',
                    label: 'basket.checkout',
                    icon: 'icon-ribbon',
                },
                {
                    current: this.current === 'confirmation',
                    label: 'basket.confirmation',
                    icon: 'icon-circlecheck',
                },
                {
                    label: 'basket.order_placed',
                    icon: 'icon-gift',
                },
            ];
        },

        components: {
            MultistepIndicator,
        },
    };
</script>