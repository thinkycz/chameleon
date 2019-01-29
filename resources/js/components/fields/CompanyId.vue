<template>
    <div class="input-wrap has-addon">
        <label for="last_name">{{ $trans('profiles.company_id') }}</label>
        <div class="relative">
            <input type="number"
                id="company_id"
                class="input"
                name="company_id"
                v-model="company_id"
                :placeholder="$trans('profiles.company_id_label')">
            <ares-fetcher @change="handleOnChange($event)"
                :company_id="company_id"></ares-fetcher>
        </div>
    </div>
</template>

<script>
    import AresFetcher from './../services/AresFetcher';

    export default {
        props: {
            old: {
                required: false,
                default: '',
            },
        },

        data: () => ({
            company_id: '',
        }),

        methods: {
            handleOnChange(values) {
                Object.keys(values).forEach(function(key) {
                    let value = values[key] instanceof Object ? values[key][0] : values[key];
                    document.querySelector(`[name="${key}"]`).value = value;
                });
            },
        },

        created() {
            this.company_id = this.old;
        },

        components: {
            AresFetcher,
        },
    };
</script>