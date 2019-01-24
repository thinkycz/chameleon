<script>
    import { required } from 'vuelidate/lib/validators';
    import { validationMixin } from 'vuelidate';

    export default {
        props: {
            action: {
                required: true,
            },
        },

        data: () => ({
            company_name: '',
            phone: '',
            company_id: '',
            first_name: '',
            last_name: '',
            street: '',
            city: '',
            zipcode: '',
            country_id: '',
            vat_id: '',
        }),

        methods: {
            submit() {
                this.$v.$touch();

                if (this.$v.$invalid) {
                    return;
                }

                axios
                    .post(this.action, this.$data)
                    .then(({ data }) => {
                        this.addAddressToStore(data.address);
                        this.reset();
                        this.$toasted.success(data.message);
                        document.querySelector('.close').click();
                    })
                    .catch(err => {
                        console.log(err);
                        this.$toasted.error(response.data.message);
                    });
            },

            reset() {
                Array.from(this.$data).forEach(input => (input = ''));
            },

            addAddressToStore(address) {
                this.$store.commit('addAddress', address);
            },
        },

        validations: {
            company_name: {
                required,
            },

            phone: {
                required,
            },

            company_id: {
                required,
            },

            first_name: {
                required,
            },

            last_name: {
                required,
            },

            street: {
                required,
            },

            city: {
                required,
            },

            zipcode: {
                required,
            },

            country_id: {
                required,
            },
        },

        mixins: [validationMixin],
    };
</script>