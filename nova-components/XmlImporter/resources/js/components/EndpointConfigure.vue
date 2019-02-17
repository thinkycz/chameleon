<template>
    <div>
        <heading class="mb-6">{{ __('xml_importer_endpoint_config') }}</heading>

        <div class="card overflow-hidden">
            <form autocomplete="off">
                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="endpoint_url">
                            {{ __('endpoint_url') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="endpoint_url"
                                id="endpoint_url"
                                type="text"
                                :placeholder="__('endpoint_url')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="run_daily">
                            {{__('run_daily')}}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <select v-model="run_daily"
                                name="run_daily"
                                id="run_daily"
                                required="required"
                                class="w-full form-control form-select">
                            <option value="false">{{__('disabled')}}</option>
                            <option value="true">{{__('enabled')}}</option>
                        </select>
                    </div>
                </div>

                <div class="bg-30 flex px-8 py-4">
                    <button type="button"
                            class="btn btn-default btn-primary inline-flex items-center relative ml-auto mr-3"
                            @click="saveConfiguration">
                        <span class="">{{ __('save_config') }}</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                endpoint_url: '',
                run_daily: false
            };
        },

        methods: {
            saveConfiguration() {
                Nova.request()
                    .post('/nova-vendor/xml-importer/endpoint/save-configuration', this.$data)
                    .then(() => {
                        this.$toasted.success(this.__('configuration_saved'));
                        this.$router.push('/xml-importer');
                    });
            },
        },

        mounted() {
            Nova.request()
                .get('/nova-vendor/xml-importer/endpoint/settings')
                .then(({data}) => {
                    this.endpoint_url = data.payload ? data.payload.endpoint_url : this.endpoint_url;
                    this.run_daily = data.payload ? data.payload.run_daily : this.run_daily;
                });
        }
    };
</script>
