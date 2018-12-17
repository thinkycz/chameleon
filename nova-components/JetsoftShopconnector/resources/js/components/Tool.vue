<template>
    <div>
        <div class="flex">
            <heading class="mb-6 flex-no-shrink">Jetsoft Shopconnector</heading>

            <div class="w-full flex items-center mb-6">
                <div class="flex w-full justify-end items-center mx-3"></div>
                <div class="flex-no-shrink ml-auto">
                    <router-link to="/jetsoft-shopconnector/configure" class="btn btn-default btn-primary">Configuration</router-link>
                </div>
            </div>
        </div>

        <card class="flex flex-col items-center justify-center" style="min-height: 300px">

            <h1 class="text-90 text-4xl text-90 font-light mb-6">
                Click here to sync
            </h1>

            <router-link to="jetsoft-shopconnector/sync" class="btn btn-default btn-primary">Sync Now</router-link>
        </card>
    </div>
</template>

<script>
    export default {
        methods: {}
    }
</script>
