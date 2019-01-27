<template>
    <button :class="buttonClass"
        @click.stop="toggle"
        type="button"
        role="button">
        <span>{{ label }}</span>

        <portal :to="accordion">
            <div class="accordion"
                :class="{'open': isOpen}"
                v-click-outside="close">
                <slot></slot>
            </div>
        </portal>

    </button>
</template>

<script>
    import vClickOutside from 'v-click-outside';

    export default {
        props: {
            buttonClass: {
                required: true,
            },

            label: {
                required: true,
            },

            accordion: {
                required: true,
            },
        },

        data: () => ({
            isOpen: false,
        }),

        methods: {
            toggle() {
                this.isOpen = !this.isOpen;
            },

            close() {
                if (this.isOpen) {
                    this.isOpen = false;
                }
            },
        },

        directives: {
            clickOutside: vClickOutside.directive,
        },
    };
</script>