<template>
    <div>
        <heading class="mb-6">Jetsoft Shopconnector Configuration</heading>

        <div class="card overflow-hidden">
            <form autocomplete="off">
                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight" for="eshopname">
                            Eshop Name
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="eshopname" id="eshopname" type="text" placeholder="Eshop Name" class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight" for="identifier">
                            Identifier
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <select v-model="identifier" name="identifier" id="identifier" required="required" class="w-full form-control form-select">
                            <option value="barcode" selected="selected">Čárový kód</option>
                            <option value="catalogueNumber">Katalogové číslo</option>
                        </select>
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight" for="host">
                            Host
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="host" id="host" type="text" placeholder="Host" class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight" for="port">
                            Port
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="port" id="port" type="text" placeholder="Port" class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight" for="database">
                            Database
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="database" id="database" type="text" placeholder="Database" class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight" for="username">
                            Username
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="username" id="username" type="text" placeholder="Username" class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight" for="password">
                            Password
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="password" id="password" type="text" placeholder="Password" class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="bg-30 flex px-8 py-4">
                    <button type="button"
                            class="btn btn-default btn-primary inline-flex items-center relative ml-auto mr-3"
                            @click="saveConfiguration"
                    >
                        <span class="">Save Configuration</span>
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
            }
        },

        methods: {
            saveConfiguration() {
                Nova.request()
                    .post('/nova-vendor/jetsoft-shopconnector/save-configuration', this.$data)
                    .then(() => {
                        this.$toasted.show('Configuration saved!', {type: 'success'});
                        this.$router.push('/jetsoft-shopconnector');
                    });
            }
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
                });
        },
    }
</script>
