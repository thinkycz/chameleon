<template>
    <div>
        <div class="flex">
            <heading class="mb-6 flex-no-shrink">{{ __('bulk_images_upload') }}</heading>
        </div>

        <image-upload></image-upload>
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