<template>
    <span></span>
</template>


<script>
    export default {
        props: {
            type: {
                required: true,
            },

            text: {
                required: true,
            },
        },

        mounted() {
            this.$toasted.show(this.text, {
                type: this.type,
            });
        },
    };
</script>