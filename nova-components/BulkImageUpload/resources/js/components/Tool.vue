<template>
    <div>
        <div class="flex">
            <heading class="mb-6 flex-no-shrink">{{ __('bulk_images_upload') }}</heading>
        </div>

        <card class="flex flex-col items-center justify-center"
            style="min-height: 300px">
            <image-upload></image-upload>
        </card>

    </div>
</template>

<script>
    import ImageUpload from './ImageUpload';

    export default {
        components: {
            ImageUpload,
        },
    };
</script>