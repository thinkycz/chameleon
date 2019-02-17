<template>
    <div>
        <heading class="mb-6">{{ __('jetsoft_shopconnector_config') }}</heading>

        <div class="card overflow-hidden">
            <form autocomplete="off">
                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="eshopname">
                            {{ __('eshop_name') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="eshopname"
                            id="eshopname"
                            type="text"
                            :placeholder="__(eshop_name)"
                            class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="identifier">
                            {{ __('identifier') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <select v-model="identifier"
                            name="identifier"
                            id="identifier"
                            required="required"
                            class="w-full form-control form-select">
                            <option value="barcode"
                                selected="selected">{{ __('barcode') }}</option>
                            <option value="catalogueNumber">{{ __('catalogue_number') }}</option>
                        </select>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="host">
                            {{ __('host') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="host"
                            id="host"
                            type="text"
                            :placeholder="__('host')"
                            class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="port">
                            {{ __('port') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="port"
                            id="port"
                            type="text"
                            :placeholder="__('port')"
                            class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="database">
                            {{ __('database') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="database"
                            id="database"
                            type="text"
                            :placeholder="__('database')"
                            class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="username">
                            {{ __('username') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="username"
                            id="username"
                            type="text"
                            :placeholder="__('username')"
                            class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="password">
                            {{ __('password') }}
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="password"
                            id="password"
                            type="text"
                            :placeholder="__('password')"
                            class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                                for="identifier">
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
                eshopname: '',
                identifier: 'barcode',
                host: '',
                port: '',
                database: '',
                username: '',
                password: '',
                run_daily: false,
            };
        },

        methods: {
            saveConfiguration() {
                Nova.request()
                    .post('/nova-vendor/jetsoft-shopconnector/save-configuration', this.$data)
                    .then(() => {
                        this.$toasted.success(this.__('configuration_saved'));
                        this.$router.push('/jetsoft-shopconnector');
                    });
            },
        },

        mounted() {
            Nova.request()
                .get('/nova-vendor/jetsoft-shopconnector/settings')
                .then(({ data }) => {
                    this.eshopname = data.payload ? data.payload.eshopname : this.eshopname;
                    this.identifier = data.payload ? data.payload.identifier : this.identifier;
                    this.host = data.payload ? data.payload.host : this.host;
                    this.port = data.payload ? data.payload.port : this.port;
                    this.database = data.payload ? data.payload.database : this.database;
                    this.username = data.payload ? data.payload.username : this.username;
                    this.password = data.payload ? data.payload.password : this.password;
                    this.run_daily = data.payload ? data.payload.run_daily : this.run_daily;
                });
        },
    };
</script>
