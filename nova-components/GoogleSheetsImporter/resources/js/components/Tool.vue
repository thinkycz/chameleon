<template>
    <div>
        <div class="flex">
            <heading class="mb-6 flex-no-shrink">Google Sheets Importer</heading>

            <div class="w-full flex items-center mb-6">
                <div class="flex w-full justify-end items-center mx-3"></div>
                <div class="flex-no-shrink ml-auto">
                    <router-link to="/google-sheets-importer/configure"
                        class="btn btn-default btn-primary">Configuration</router-link>
                </div>
            </div>
        </div>

        <card class="flex flex-col items-center justify-center"
            style="min-height: 300px">

            <h1 class="text-90 text-4xl text-90 font-light mb-6">
                Click here to sync
            </h1>

            <button type="button"
                class="btn btn-default btn-primary"
                @click="sync">
                <span class="">Sync Now</span>
            </button>

        </card>
    </div>
</template>

<script>
    export default {
        methods: {
            sync() {
                Nova.request()
                    .post('/nova-vendor/google-sheets-importer/sync')
                    .then(() => {
                        this.$toasted.show('Syncing in progress!', { type: 'success' });
                    })
                    .catch(err => {
                        this.$toasted.show('Please check your configuration!', { type: 'error' });
                    });
            },
        },
    };
</script>

<style>
    /* Scoped Styles */
</style>
