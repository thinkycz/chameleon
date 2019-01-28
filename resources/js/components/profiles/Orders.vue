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
                this.updateQuery(order.id);
            },

            handleClickOnBack() {
                this.current = null;
                this.updateQuery();
            },

            updateQuery(order = null) {
                window.updateQueryStringParam('order', order);
            },
        },
    };
</script>