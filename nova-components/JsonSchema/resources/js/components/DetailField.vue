<template>
    <div>
        <div v-for="(value, key) in field.value" class="flex border-b border-40">
            <div class="w-1/4 py-4">
                <slot>
                    <h4 class="font-normal text-80">
                        {{ this._.capitalize(key) }}
                    </h4>
                </slot>
            </div>
            <div class="w-3/4 py-4">
                <slot name="value">
                    <p v-if="value && !shouldDisplayAsHtml" class="text-90">{{ value }}</p>
                    <div v-else-if="value && shouldDisplayAsHtml" v-html="value"></div>
                    <p v-else>&mdash;</p>
                </slot>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['resource', 'resourceName', 'resourceId', 'field'],

        computed: {
            shouldDisplayAsHtml() {
                return this.field.asHtml
            }
        }
    }
</script>
