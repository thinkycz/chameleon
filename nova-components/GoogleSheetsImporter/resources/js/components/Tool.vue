<template>
    <div>
        <div class="flex">
            <heading class="mb-6 flex-no-shrink">{{__('google_sheets_importer')}}</heading>

            <div class="w-full flex items-center mb-6">
                <div class="flex w-full justify-end items-center mx-3"></div>
                <div class="flex-no-shrink ml-auto">
                    <router-link to="/google-sheets-importer/configure"
                        class="btn btn-default btn-primary">{{ __('configuration') }}
                    </router-link>
                </div>
            </div>
        </div>

        <card class="flex flex-col p-8">

            <div class="flex my-4">
                <div class="w-1/4 font-bold">{{ __('last_update') }}</div>
                <div class="w-3/4">{{ lastUpdate }}</div>
            </div>

            <div class="flex my-4">
                <div class="w-1/4 font-bold">{{ __('duration') }}</div>
                <div class="w-3/4">{{ duration }}</div>
            </div>

            <div class="flex my-4">
                <div class="w-1/4 font-bold">{{ __('status') }}</div>
                <div class="w-3/4">{{ status }}</div>
            </div>

            <div class="flex my-4">
                <div class="w-3/4 ml-auto">
                    <button type="button"
                        class="btn btn-default btn-primary"
                        @click="sync">{{ __('sync_now') }}</button>
                    <button type="button"
                        class="btn btn-default btn-primary"
                        @click="refresh">{{ __('refresh_status') }}</button>
                </div>
            </div>

        </card>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                lastUpdate: null,
                duration: null,
                status: null,
            };
        },
        methods: {
            sync() {
                Nova.request()
                    .post('/nova-vendor/google-sheets-importer/sync')
                    .then(() => {
                        this.$toasted.success(this.__('syncing_in_progress'));
                        setTimeout(this.refresh, 2000);
                    })
                    .catch(err => {
                        this.$toasted.success(this.__('please_check_config'));
                    });
            },

            refresh() {
                Nova.request()
                    .get('/nova-vendor/google-sheets-importer/status')
                    .then(({ data }) => {
                        this.lastUpdate = data.payload.lastUpdate;
                        this.duration = data.payload.duration;
                        this.status = data.payload.status;
                    });
            },
        },
        created() {
            this.refresh();
        },
    };
</script>

<style>
    /* Scoped Styles */
</style>
