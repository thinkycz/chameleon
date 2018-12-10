<template>
    <default-field :field="field" :errors="errors" :full-width-content="true">
        <template slot="field">
            <div class="input-group">
                <textarea v-for="(_, locale) in locales"
                        v-show="locale === currentLocale"
                        :id="field.name"
                        class="form-control form-input form-input-bordered py-3 h-auto flex-1 rounded-r-none"
                        :class="errorClasses"
                        :placeholder="field.name"
                        v-model="value[locale]"
                        v-bind="extraAttributes"
                ></textarea>
                <div class="input-group-append">
                    <dropdown-menu-translatable-textarea v-model="currentLocale"></dropdown-menu-translatable-textarea>
                </div>
            </div>
        </template>
    </default-field>
</template>

<script>
    import {FormField, HandlesValidationErrors} from 'laravel-nova'

    export default {
        mixins: [FormField, HandlesValidationErrors],

        props: ['resourceName', 'resourceId', 'field'],

        data() {
            return {
                locales: Nova.config.locales,
                currentLocale: Nova.config.currentLocale,
            }
        },

        computed: {
            defaultAttributes() {
                return {
                    rows: this.field.rows,
                    class: this.errorClasses,
                    placeholder: this.field.name,
                }
            },

            extraAttributes() {
                const attrs = this.field.extraAttributes

                return {
                    ...this.defaultAttributes,
                    ...attrs,
                }
            },
        },

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
                Object.keys(this.value).forEach(locale => {
                    formData.append(this.field.attribute + '[' + locale + ']', this.value[locale] || '')
                })
            },

            /**
             * Update the field's internal value.
             */
            handleChange(value) {
                this.value[this.currentLocale] = value
            },
        },
    }
</script>
