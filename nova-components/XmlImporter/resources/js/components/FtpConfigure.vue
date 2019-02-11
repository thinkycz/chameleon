<template>
    <div>
        <heading class="mb-6">{{ __('xml_importer_ftp_config') }}</heading>

        <div class="card overflow-hidden">
            <form autocomplete="off">
                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="ftp_host">
                            {{ __('ftp_host') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="ftp_host"
                                id="ftp_host"
                                type="text"
                                :placeholder="__('ftp_host')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="ftp_username">
                            {{ __('ftp_username') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="ftp_username"
                                id="ftp_username"
                                type="text"
                                :placeholder="__('ftp_username')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="ftp_password">
                            {{ __('ftp_password') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="ftp_password"
                                id="ftp_password"
                                type="text"
                                :placeholder="__('ftp_password')"
                                class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="ftp_filepath">
                            {{ __('ftp_filepath') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="ftp_filepath"
                                id="ftp_filepath"
                                type="text"
                                :placeholder="__('ftp_filepath')"
                                class="w-full form-control form-input form-input-bordered">
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
                ftp_host: '',
                ftp_username: '',
                ftp_password: '',
                ftp_filepath: ''
            };
        },

        methods: {
            saveConfiguration() {
                Nova.request()
                    .post('/nova-vendor/xml-importer/ftp/save-configuration', this.$data)
                    .then(() => {
                        this.$toasted.success(this.__('configuration_saved'));
                        this.$router.push('/xml-importer');
                    });
            },
        },

        mounted() {
            Nova.request()
                .get('/nova-vendor/xml-importer/ftp/settings')
                .then(({data}) => {
                    let settings = data.payload.settings;

                    if (settings) {
                        this.ftp_host = settings.ftp_host ? settings.ftp_host : null;
                        this.ftp_username = settings.ftp_username ? settings.ftp_username : null;
                        this.ftp_password = settings.ftp_password ? settings.ftp_password : null;
                        this.ftp_filepath = settings.ftp_filepath ? settings.ftp_filepath : null;
                    }
                });
        }
    };
</script>
