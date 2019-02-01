<template>
    <div class="col-sm-12">
        <div class="form-group">
            <label>{{ $trans('admin.store.bulk_image_upload.product_identifier') }}</label>
            <select title="identifier"
                name="identifier"
                class="form-control"
                v-model="identifier"
                required>
                <option value="barcode">{{ $trans('admin.store.bulk_image_upload.barcode') }}</option>
                <option value="catalogue_number">{{ $trans('admin.store.bulk_image_upload.catalogue_number') }}</option>
            </select>
        </div>

        <image-dropzone :mass-upload-identifier="identifier"
            :is-delete-enabled="false"
            :max-images="100"
            :element-id="elementId"
            :route="route">
        </image-dropzone>
    </div>
</template>

<script>
    import ImageDropzone from './ImageDropzone';

    export default {
        data() {
            return {
                currentLocale: window.currentLocale,
                identifier: 'barcode',
            };
        },

        props: {
            elementId: {
                required: true,
            },

            route: {
                required: true,
            },
        },

        components: {
            ImageDropzone,
        },
    };
</script>