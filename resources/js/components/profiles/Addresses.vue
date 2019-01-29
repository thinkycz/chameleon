<script>
    export default {
        props: {
            new: {
                required: false,
                default: null,
            },
        },

        data: () => ({
            current: null,
        }),

        methods: {
            handleAddressBoxClicked(address) {
                if (address == 'new') {
                    return (this.current = 'new');
                }
                return this.handleUpdatingAnAddress(address);
            },

            handleUpdatingAnAddress(address) {
                this.current = address;
            },

            updateAddressAction(route) {
                return `${route}/${this.current.id}`;
            },

            handleClickOnBack() {
                this.current = null;
            },

            handleAddressBoxDestroyed(route) {
                axios.delete(route).then(({ data }) => {
                    window.location.href = data.redirect;
                });
            },

            handleAddressMakeDefault(route) {
                axios.post(`${route}/make-default`).then(({ data }) => {
                    window.location.href = data.redirect;
                });
            },
        },

        created() {
            if (this.new) {
                this.current = 'new';
            }
        },
    };
</script>