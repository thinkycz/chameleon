<template>
    <div>
        <div class="flex">
            <heading class="mb-6 flex-no-shrink">{{ __('jetsoft_shopconnector') }}</heading>

            <div class="w-full flex items-center mb-6">
                <div class="flex w-full justify-end items-center mx-3"></div>
                <div class="flex-no-shrink ml-auto">
                    <router-link to="/jetsoft-shopconnector/configure"
                        class="btn btn-default btn-primary">{{ __('configuration') }}</router-link>
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
                <div class="w-1/4 font-bold">{{ __('run_daily') }}</div>
                <div class="w-3/4">{{ __(run_daily) }}</div>
            </div>

            <div class="flex my-4">
                <div class="w-3/4 ml-auto">

                    <progress-button dusk="sync-button"
                        class="btn btn-default btn-primary"
                        @click.native="sync"
                        :disabled="loading"
                        :processing="loading">
                        {{ __('sync_now') }}
                    </progress-button>

                    <progress-button dusk="refresh-button"
                        class="btn btn-default btn-primary"
                        @click.native="refresh"
                        :disabled="loading"
                        :processing="loading">
                        {{ __('refresh_status') }}
                    </progress-button>

                </div>
            </div>

        </card>
    </div>
</template>

<script>
    export default {
        data: () => ({
            lastUpdate: null,
            duration: null,
            status: null,
            run_daily: null,
            loading: false,
        }),

        methods: {
            sync() {
                this.loading = true;

                Nova.request()
                    .post('/nova-vendor/jetsoft-shopconnector/sync')
                    .then(() => {
                        this.$toasted.success(this.__('syncing_in_progress'));
                        setTimeout(this.refresh, 2000);
                    })
                    .catch(err => {
                        this.$toasted.error(this.__('please_check_config'));
                    })
                    .then(() => {
                        this.loading = false;
                    });
            },

            refresh() {
                this.loading = true;

                Nova.request()
                    .get('/nova-vendor/jetsoft-shopconnector/status')
                    .then(({ data }) => {
                        this.lastUpdate = data.payload.lastUpdate;
                        this.duration = data.payload.duration;
                        this.status = data.payload.status;
                        this.run_daily = data.payload.run_daily == 'true' ? 'enabled' : 'disabled';
                    })
                    .then(() => {
                        this.loading = false;
                    });
            },
        },

        created() {
            this.refresh();
        },
    };
</script>
