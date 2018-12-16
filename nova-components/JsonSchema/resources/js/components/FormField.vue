<template>
    <div>
        <default-field v-for="(property, key) in properties" :key="key" :field="field" :errors="errors">
            <form-label :for="field.attribute" :class="{ 'mb-2': field.helpText && showHelpText }">
                {{ this._.capitalize(key) }}
            </form-label>
            <template slot="field">
                <input :id="key" type="text"
                        class="w-full form-control form-input form-input-bordered"
                        :class="errorClasses"
                        :placeholder="this._.capitalize(key)"
                        v-model="value[key]"
                />
            </template>
        </default-field>
    </div>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        methods: {
            /*
             * Set the initial, internal value for the field.
             */
            setInitialValue() {
                this.value = this.field.value || {}
            },

            /**
             * Fill the given FormData object with the field's internal value.
             */
            fill(formData) {
                Object.keys(this.value).forEach(property => {
                    formData.append(this.field.attribute + '[' + property + ']', this.value[property] || '')
                })
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value = value
            },
        },

        computed: {
            properties() {
                return this.field.options.schema.properties;
            }
        },
    }
</script>
