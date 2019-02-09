<template>
    <checkbox
            class="py-2"
            @input="toggle"
            :checked="value"
            :id="name"
            :name="name">
        <label :for="name" class="text-90 text-sm mx-2">Static Text</label>
    </checkbox>
</template>

<script>
    export default {
        props: ['value', 'name'],

        methods: {
            toggle() {
                this.$emit('input', !this.value);
            }
        }
    }
</script>