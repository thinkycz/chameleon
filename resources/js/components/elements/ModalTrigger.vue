<template>
    <button class="btn btn-primary"
        @click="openModal"
        role="button">
        <span>{{ label }}</span>

        <portal :to="modal">
            <vue-modal :open="open"
                @close="close">
                <slot></slot>
            </vue-modal>
        </portal>
    </button>
</template>

<script>
    export default {
        props: {
            modal: {
                required: true,
            },

            label: {
                required: true,
            },
        },

        data() {
            return {
                open: false,
            };
        },

        methods: {
            openModal() {
                this.open = true;
            },

            close() {
                this.open = false;
            },
        },
    };
</script>