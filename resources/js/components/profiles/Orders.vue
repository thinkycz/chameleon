<script>
    export default {
        data() {
            return {
                current: null,
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