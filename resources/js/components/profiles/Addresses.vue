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

            destroy(route) {
                axios.delete(route).then(({ data }) => {
                    window.location.href = data.redirect;
                });
            },
        },
    };
</script>