<script>
    import { ClickOutside } from './../../directives/ClickOutside';

    export default {
        data: () => ({
            visible: false,
        }),

        methods: {
            toggle() {
                this.visible = !this.visible;
            },

            close() {
                if (this.visible) {
                    this.visible = false;
                }
            },
        },

        directives: {
            ClickOutside,
        },
    };
</script>