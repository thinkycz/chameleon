<template>
    <div>
        <div class="card overflow-hidden mb-6">
            <div class="flex border-b border-40">
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
                                selected="selected">{{ __('barcode') }}
                        </option>
                        <option value="catalogue_number">{{ __('catalogue_number') }}</option>
                    </select>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="w-1/5 py-6 px-8">
                    <label class="inline-block text-80 pt-2 leading-tight"
                            for="separator">
                        {{ __('separator') }}
                    </label>
                </div>
                <div class="py-6 px-8 w-1/2">
                    <select v-model="separator"
                            name="separator"
                            id="separator"
                            required="required"
                            class="w-full form-control form-select">
                        <option value="|" selected="selected">{{ '|' }}</option>
                        <option value="=">{{ '=' }}</option>
                    </select>
                </div>
            </div>
            <div class="flex border-b border-40">
                <div class="py-6 px-8 w-full">
                    <p class="mb-4 text-sm text-80">{{ __('bulk_images_upload_note') }}</p>
                </div>
            </div>
        </div>

        <image-dropzone class="w-full"
                :identifier="identifier"
                :separator="separator"
                :delete-route="deleteRoute"
                :max-images="100"
                :element-id="'dropzone' + _uid"
                :route="route">
        </image-dropzone>
    </div>
</template>

<script>
    import ImageDropzone from './ImageDropzone';

    const route = '/nova-vendor/bulk-image-upload';

    export default {
        data: () => ({
            identifier: 'barcode',
            separator: '|',
            route: `${route}/upload`,
            deleteRoute: `${route}/destroy`,
        }),

        components: {
            ImageDropzone,
        },
    };
</script>