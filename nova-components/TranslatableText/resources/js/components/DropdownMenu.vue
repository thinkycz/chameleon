<template>
    <div>
        <button type="button" class="form-input-bordered rounded-l-none dropdown-toggle h-full">
            <img :src="getFlag(currentLocale)" :alt="currentLocale"/>
        </button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                currentValues: {},
                locales: Nova.config.locales,
                currentLocale: Nova.config.currentLocale,
                flagsPath: Nova.config.flagsPath,
            }
        },
        methods: {
            getFlag(locale) {
                return this.flagsPath + '/' + locale + '.png';
            },
            getContent(locale) {
                return typeof this.value[locale] !== 'undefined' ? this.value[locale] : '';
            }
        },
        created() {
            Array.from(this.locales).forEach(locale => {
                this.currentValues[locale] = this.getContent(locale);
            });
        }
    }
</script>