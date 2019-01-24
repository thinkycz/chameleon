<template>
    <div class="input-wrap">
        <label for="country_id">{{ $trans('checkout.select_existing_address') }}</label>
        <select required
            :name="name"
            v-model="selected"
            class="input">
            <option value="">&mdash;</option>
            <option v-for="address in addresses"
                :value="address.id"
                :key="'address-' + address.id">{{ address.title }}</option>
        </select>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex';

    export default {
        props: {
            name: {
                required: true,
            },
        },

        data() {
            return {
                selected: null,
            };
        },

        computed: {
            ...mapGetters({
                addresses: 'getAddresses',
            }),
        },

        created() {
            if (this.addresses.length > 0) {
                let address = this.addresses.find(a => a.is_default);

                if (typeof address !== 'undefined') {
                    this.selected = address.id;
                } else {
                    this.selected = this.addresses[0].id;
                }
            }
        },
    };
</script>