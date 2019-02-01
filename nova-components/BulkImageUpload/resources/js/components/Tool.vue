<template>
    <div>
        <div class="flex">
            <heading class="mb-6 flex-no-shrink">Bulk Image uploader</heading>
        </div>

        <card class="flex flex-col items-center justify-center"
            style="min-height: 300px">

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
