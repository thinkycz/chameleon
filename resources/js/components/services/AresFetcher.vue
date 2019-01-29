<template>
    <span class="addon cursor-pointer"
        :class="{'loading': loading}"
        @click.stop.prevent="fetch">
        <span style="top: 8px">
            <component :is="icon"></component>
        </span>
    </span>
</template>

<script>
    export default {
        props: {
            company_id: {
                required: true,
            },
        },

        data: () => ({
            loading: false,
        }),

        computed: {
            icon() {
                return this.loading ? 'icon-sync' : 'icon-magic';
            },
        },

        methods: {
            parseStreet(data) {
                let street = data.street.reduce((accumulator, currentValue, i) => {
                    if (currentValue instanceof Object) {
                        return accumulator + currentValue[0] + (i === 1 ? '/' : ' ');
                    } else {
                        return accumulator;
                    }
                }, '');

                return street.endsWith('/') ? street.slice(0, -1) : street;
            },

            fetch() {
                this.loading = true;

                axios
                    .get(`/ajax/ares?company_id=${this.company_id}`)
                    .then(({ data }) => {
                        if (data.company_id) {
                            let street = this.parseStreet(data);
                            let values = { ...data, street };
                            this.$emit('change', values);
                        }
                    })
                    .catch(({ response }) => {
                        this.$toasted.error(response.data.message);
                    })
                    .then(() => {
                        this.loading = false;
                    });
            },
        },
    };
</script>