<template>
    <transition name="fade-shrink-in"
        appear>
        <div v-show="open"
            @click="close"
            class="absolute pin p-8 z-100 overflow-hidden"
            style="background-color: hsla(0, 0%, 0%, .5)">
            <div @click.stop
                class="max-w-md w-full mx-auto bg-white rounded p-6 mt-8 shadow-lg"
                style="z-index: 101;">
                <slot></slot>
            </div>
        </div>
    </transition>
</template>

<script>
    export default {
        props: {
            open: {
                required: true,
            },
        },

        methods: {
            close() {
                this.$emit('close');
            },
        },

        mounted() {
            document.addEventListener('keydown', e => {
                if (this.open && e.keyCode == 27) {
                    this.close();
                }
            });

            let close = this.$el.querySelector('.close');
            if (close) {
                close.addEventListener('click', e => {
                    if (this.open) {
                        this.close();
                    }
                });
            }
        },
    };
</script>