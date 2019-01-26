import vClickOutside from 'v-click-outside';

export const DropdownMixin = {
    data: function() {
        return {
            visible: false,
        };
    },

    methods: {
        toggle: function() {
            this.visible = !this.visible;
        },

        close: function(e) {
            if (this.visible) {
                this.visible = false;
            }
        },

        blank: function() {
            // do nothing (to prevent propagation)
        },
    },

    directives: {
        clickOutside: vClickOutside.directive,
    },
};
