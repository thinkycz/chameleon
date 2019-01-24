<script>
    export default {
        props: {
            order: {
                required: false,
                default: null,
            },
        },

        data() {
            return {
                current: this.order,
                locale: window.currentLocale,
            };
        },

        methods: {
            handleOrderBoxClicked(order) {
                this.current = order;
            },

            handleClickOnBack() {
                this.current = null;
            },
        },
    };
</script>