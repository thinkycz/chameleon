<script>
    export default {
        data() {
            return {
                current: null,
            };
        },

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
        },
    };
</script>