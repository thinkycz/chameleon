<template>
    <div class="w-full">

        <div class="flex border-b border-40 justify-center">
            <div class="w-1/5 py-6 px-8">
                <label class="inline-block text-80 pt-2 leading-tight"
                    for="identifier">
                    {{ __('identifier') }}
                </label>
            </div>
            <div class="py-6 px-8 w-1/2">
                <select v-model="identifier"
                    name="identifier"
                    id="identifier"
                    required="required"
                    class="w-full form-control form-select">
                    <option value="barcode"
                        selected="selected">{{ __('barcode') }}</option>
                    <option value="catalogue_number">{{ __('catalogue_number') }}</option>
                </select>
            </div>
        </div>

        <div class="flex justify-center">
            <div class="w-full max-w-md py-6">
                <image-dropzone :identifier="identifier"
                    :delete-route="deleteRoute"
                    :max-images="100"
                    :element-id="'dropzone' + _uid"
                    :route="route">
                </image-dropzone>
            </div>
        </div>

    </div>
</template>

<script>
    import ImageDropzone from '@dropzone';
    const route = '/nova-vendor/bulk-image-upload';

    export default {
        data: () => ({
            identifier: 'barcode',
            route: `${route}/upload`,
            deleteRoute: `${route}/destroy`,
        }),

        components: {
            ImageDropzone,
        },
    };
</script>