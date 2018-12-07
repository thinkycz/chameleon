<template>
    <div class="relative">
        <button type="button" class="form-input-bordered rounded-l-none dropdown-toggle h-full" @click="toggleDropdown">
            <img :src="getFlag(currentLocale)" :alt="currentLocale"/>
        </button>
        <div class="rounded shadow-md mt-8 absolute pin-t pin-r bg-white" v-show="active">
            <ul class="list-reset">
                <li><a href="#" class="px-4 py-2 block text-black hover:bg-50 no-underline">My account</a></li>
                <li><a href="#" class="px-4 py-2 block text-black hover:bg-50 no-underline">Notifications</a></li>
            </ul>
        </div>
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
                active: false
            }
        },
        methods: {
            getFlag(locale) {
                return this.flagsPath + '/' + locale + '.png';
            },
            getContent(locale) {
                return typeof this.value[locale] !== 'undefined' ? this.value[locale] : '';
            },
            toggleDropdown() {
                this.active = ! this.active;
            }
        },
        created() {
            Array.from(this.locales).forEach(locale => {
                this.currentValues[locale] = this.getContent(locale);
            });
        }
    }
</script>