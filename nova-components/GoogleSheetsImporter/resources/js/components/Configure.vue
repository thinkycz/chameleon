<template>
    <div>
        <heading class="mb-6">Google Sheets Importer Configuration</heading>

        <div class="card overflow-hidden">
            <form autocomplete="off">

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="link">
                            Google Sheets Link
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <input v-model="link"
                            id="link"
                            type="text"
                            placeholder="Google Sheets Link"
                            class="w-full form-control form-input form-input-bordered">
                    </div>
                </div>

                <div class="flex border-b border-40">
                    <div class="w-1/5 py-6 px-8">
                        <label class="inline-block text-80 pt-2 leading-tight"
                            for="identifier">
                            Identifier
                        </label>
                    </div>
                    <div class="py-6 px-8 w-1/2">
                        <select v-model="identifier"
                            name="identifier"
                            id="identifier"
                            required="required"
                            class="w-full form-control form-select">
                            <option value="barcode"
                                selected="selected">Čárový kód</option>
                            <option value="catalogueNumber">Katalogové číslo</option>
                        </select>
                    </div>
                </div>

                <div class="bg-30 flex px-8 py-4">
                    <button type="button"
                        class="btn btn-default btn-primary inline-flex items-center relative ml-auto mr-3"
                        @click="saveConfiguration">
                        <span class="">Save Configuration</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- other cards go here -->

    </div>
</template>

<script>
    export default {
        data() {
            return {
                link: '',
                identifier: '',
            };
        },

        methods: {
            saveConfiguration() {
                Nova.request()
                    .post('/nova-vendor/google-sheets-importer/save-configuration', this.$data)
                    .then(() => {
                        this.$toasted.show('Configuration saved!', { type: 'success' });
                        this.$router.push('/google-sheets-importer');
                    });
            },
        },

        mounted() {
            Nova.request()
                .get('/nova-vendor/google-sheets-importer/settings')
                .then(({ data }) => {
                    this.link = data.payload.link;
                    this.identifier = data.payload.identifier;
                });
        },
    };
</script>
