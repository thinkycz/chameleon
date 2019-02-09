<template>
    <div>
        <h1 class="mb-6 text-90 font-normal text-2xl">{{ __('latest_users') }}</h1>
        <card class="flex flex-col items-center justify-center">
            <div class="px-3 py-3">
            </div>
        </card>
    </div>
</template>

<script>
    export default {
        props: {
            card: {
                required: true,
            },
        },

        mounted() {
            //
        },
    };
</script>
