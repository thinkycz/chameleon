<template>
    <button :class="buttonClass"
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

            button: {
                required: false,
                default: true,
            },
        },

        data() {
            return {
                open: false,
            };
        },

        computed: {
            buttonClass() {
                return this.button ? 'btn btn-primary' : 'btn-primary btn-text';
            },
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