<template>
    <default-field :field="field" :errors="errors">
        <template slot="field">
            <div class="input-group">
                <input v-for="(_, locale) in locales"
                        v-show="locale === currentLocale"
                        :id="field.name" type="text"
                        class="form-control form-input form-input-bordered flex-1 rounded-r-none"
                        :class="errorClasses"
                        :placeholder="field.name"
                        v-model="value[locale]"
                />
                <div class="input-group-append">
                    <dropdown-menu-translatable-text v-model="currentLocale"></dropdown-menu-translatable-text>
                </div>
            </div>
        </template>
    </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
    mixins: [FormField, HandlesValidationErrors],

    props: ['resourceName', 'resourceId', 'field'],

    data() {
        return {
            locales: Nova.config.locales,
            currentLocale: Nova.config.currentLocale,
        }
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
