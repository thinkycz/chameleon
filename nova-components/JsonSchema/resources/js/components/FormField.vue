<template>
    <div>
        <default-field v-for="(property, key) in properties"
            :key="key"
            :field="field"
            :errors="errors">
            <form-label :for="field.attribute"
                :class="{ 'mb-2': field.helpText && showHelpText }">
                {{ this._.capitalize(key) }}
            </form-label>
            <template slot="field">
                <input v-if="property.type === 'string'"
                    :id="key"
                    type="text"
                    class="w-full form-control form-input form-input-bordered"
                    :class="errorClasses"
                    :placeholder="this._.capitalize(key)"
                    v-model="value[key]" />
                <input v-if="property.type === 'number'"
                    :id="key"
                    type="number"
                    step="0.01"
                    class="w-full form-control form-input form-input-bordered"
                    :class="errorClasses"
                    :placeholder="this._.capitalize(key)"
                    v-model="value[key]" />
                <textarea v-if="property.type === 'textarea'"
                    :id="key"
                    class="w-full form-control form-input form-input-bordered"
                    :class="errorClasses"
                    :placeholder="this._.capitalize(key)"
                    v-model="value[key]"></textarea>
                <div v-if="property.type === 'image'"
                    class="flex justify-between">
                    <input :id="key"
                        type="text"
                        class="w-full form-control form-input form-input-bordered"
                        :class="errorClasses"
                        :placeholder="this._.capitalize(key)"
                        v-model="value[key]" />
                    <div class="upload-button ml-4">
                        <label :for="`file-${key}`"
                            class="button-file-upload">
                            <span class="btn btn-primary rounded p-1">
                                <icon class="rotate-180"
                                    type="download"
                                    view-box="0 0 24 24"
                                    width="40"
                                    height="22" />
                            </span>
                            <input type="file"
                                :id="`file-${key}`"
                                accept="images/*"
                                @change="handleFileChange($event, key)"
                                name="file">
                        </label>
                    </div>
                    <span v-if="uploadedFiles[key]"
                        class="ml-2 cursor-pointer text-primary font-bold"
                        @click="handleFileUpload(key)">
                        {{ __('upload_and_use') }}
                    </span>
                </div>
                <checkbox v-if="property.type === 'boolean'"
                    class="py-2"
                    @input="toggle(key)"
                    :id="field.attribute"
                    :name="field.name"
                    :checked="Boolean(value[key])" />
            </template>
        </default-field>
    </div>
</template>

<script>
    import { FormField, HandlesValidationErrors } from 'laravel-nova';

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        data: () => ({
            uploadedFiles: null,
        }),

        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || {};
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                Object.keys(this.value).forEach(property => {
                    formData.append(this.field.attribute + '[' + property + ']', this.value[property] || '');
                });
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value;
            },

            handleFileChange(e, key) {
                this.uploadedFiles[key] = e.currentTarget.files[0];
            },

            handleFileUpload(key) {
                let formData = new FormData();
                formData.append('file', this.uploadedFiles[key]);
                formData.append('collection', key);

                Nova.request()
                    .post('/nova-vendor/json-schema/upload-file', formData)
                    .then(({ data }) => {
                        this.value[key] = `${Nova.config.baseURL}${data.payload.media.url}`;
                        this.uploadedFiles[key] = null;
                    });
            },

            toggle(key) {
                this.value[key] = !this.value[key];
            },
        },

        computed: {
            properties() {
                return this.field.options.schema.properties;
            },
        },

        created() {
            let files = {};
            Object.keys(this.properties).forEach(key => {
                if (['image', 'file'].indexOf(this.properties[key].type) > -1) {
                    files[key] = null;
                }
            });

            this.uploadedFiles = files;
        },
    };
</script>

<style lang="scss" scoped>
    .button-file-upload {
        display: block;
        overflow: hidden;

        input[type='file'] {
            left: -1000px;
            position: fixed;
        }
    }
</style>