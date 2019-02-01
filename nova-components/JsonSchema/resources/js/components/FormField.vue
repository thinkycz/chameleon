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
                <input v-if="property.type === 'image'"
                    :id="key"
                    type="file"
                    accept="images/*"
                    class="w-full form-control form-input form-input-bordered"
                    :class="errorClasses"
                    :placeholder="this._.capitalize(key)" />
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

            toggle(key) {
                this.value[key] = !this.value[key];
            },
        },

        computed: {
            properties() {
                return this.field.options.schema.properties;
            },
        },
    };
</script>
