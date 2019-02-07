<template>
    <panel-item :field="field"
        :fullWidthContent="true">
        <template slot="value">
            <image-dropzone :delete-route="deleteRoute"
                :max-images="100"
                :element-id="'dropzone' + _uid"
                :prepopulate="prepopulate"
                :route="route">
            </image-dropzone>
        </template>
    </panel-item>
</template>

<script>
    import ImageDropzone from './ImageDropzone';

    let route = '/ajax/products/images';

    export default {
        props: {
            field: {
                required: true,
            },
        },

        data: () => ({
            route: null,
            deleteRoute: null,
            prepopulate: [],
        }),

        created() {
            let resource = this.field.value.resource.id;

            this.route = `${route}/upload/${resource}`;
            this.deleteRoute = `${route}/destroy`;
            this.prepopulate = this.field.value.images;
        },

        components: {
            ImageDropzone,
        },
    };
</script>
