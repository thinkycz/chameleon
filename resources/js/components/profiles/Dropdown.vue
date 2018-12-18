<script>
    import vClickOutside from 'v-click-outside';

    export default {
        data: () => ({
            visible: false,
        }),

        methods: {
            toggle() {
                this.visible = !this.visible;
            },

            close(e) {
                if (this.visible) {
                    this.visible = false;
                }
            },

            blank() {
                // do nothing (to prevent propagation)
            },
        },

        directives: {
            clickOutside: vClickOutside.directive,
        },
    };
</script>