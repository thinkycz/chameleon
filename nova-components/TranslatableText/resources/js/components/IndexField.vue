<template>
    <span>{{ field.value[currentLocale] }}</span>
</template>

<script>
export default {
    props: ['resourceName', 'field'],

    data() {
        return {
            currentLocale: Nova.config.currentLocale,
        }
    },
}
</script>
