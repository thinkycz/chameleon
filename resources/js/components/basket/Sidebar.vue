<template>
    <div class="md:w-1/4 col w-full">
        <slot></slot>
    </div>
</template>

<script>
    import StickySidebar from 'sticky-sidebar';

    export default {
        computed: {
            shouldBeAffixed() {
                return this.$mq.resize && this.$mq.above('768px');
            },
        },

        mounted() {
            if (this.shouldBeAffixed) {
                this.$el.classList.add('basket-sidebar');
                new StickySidebar('.basket-sidebar', {
                    bottomSpacing: 20,
                    topSpacing: 20,
                    containerSelector: '.main-basket',
                    innerWrapperSelector: '.basket-sidebar .inner',
                });
            }
        },
    };
</script>