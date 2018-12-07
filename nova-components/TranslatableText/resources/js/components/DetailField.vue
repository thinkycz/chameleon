<template>
    <panel-item :field="field">
        <template slot="value">
            {{ field.value[currentLocale] }}
        </template>
    </panel-item>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    data() {
        return {
            currentLocale: Nova.config.currentLocale,
        }
    },
}
</script>
