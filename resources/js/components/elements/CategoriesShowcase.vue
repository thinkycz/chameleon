<script>
    export default {
        props: {
            categories: {
                required: true,
                default: () => [],
            },
        },

        data: () => ({
            current: null,
            locale: null,
        }),

        methods: {
            change(category) {
                this.current = category;
            },
        },

        created() {
            this.locale = window.currentLocale;
            this.current = this.categories.length > 0 ? this.categories[0].id : null;
        },
    };
</script>