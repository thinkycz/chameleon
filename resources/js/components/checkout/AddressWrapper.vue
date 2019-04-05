<script>
    import { mapGetters } from 'vuex';

    export default {
        props: {
            addresses: {
                required: true,
            },
        },

        computed: {
            ...mapGetters({
                currentAddresses: 'getAddresses',
            }),
        },

        created() {
            this.$store.commit('setAddresses', this.addresses);
        },
    };
</script>