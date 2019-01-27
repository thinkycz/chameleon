<template>
    <div class="relative">
        <button type="button"
            class="form-input-bordered rounded-l-none dropdown-toggle h-full"
            @click="toggleDropdown()">
            <img :src="getFlag(currentValue)"
                :alt="currentValue" />
        </button>
        <div class="lang-dropdown rounded shadow-md absolute pin-t pin-r bg-white"
            v-show="active">
            <ul class="list-reset">
                <li v-for="(locale, key) in locales"
                    :key="'locale-' + key"
                    @click.prevent="changeLocale(key)">
                    <a href="#"
                        @click.prevent="blank"
                        class="px-4 py-2 block text-black hover:bg-50 no-underline">
                        <img :src="getFlag(key)"
                            :alt="key">&nbsp;{{ locale }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<style>
    .lang-dropdown {
        margin-top: 2.5rem;
    }
</style>

<script>
    export default {
        props: ['value'],
        data() {
            return {
                currentValue: this.value,
                locales: Nova.config.locales,
                flagsPath: Nova.config.flagsPath,
                active: false,
            };
        },
        watch: {
            currentValue(value) {
                this.$emit('input', value);
            },
        },
        methods: {
            getFlag(locale) {
                return this.flagsPath + '/' + locale + '.png';
            },

            getContent(locale) {
                return typeof this.value[locale] !== 'undefined' ? this.value[locale] : '';
            },

            toggleDropdown() {
                this.active = !this.active;
            },

            changeLocale(locale) {
                this.currentValue = locale;
                this.active = false;
            },

            blank() {
                //
            },
        },
        created() {
            Array.from(this.locales).forEach(locale => {
                this.currentValues[locale] = this.getContent(locale);
            });
        },
    };
</script>