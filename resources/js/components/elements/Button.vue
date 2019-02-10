<template>
    <button role="button"
        :class="buttonClass"
        :disabled="isDisabled"
        type="button"
        @click.stop.prevent="click">
        <span class="icon-wrap">
            <span>{{ label }}</span>
            <span v-if="isDisabled"
                class="icon-loading icon-sm ml-2">
                <icon-sync></icon-sync>
            </span>
        </span>
    </button>
</template>

<script>
    export default {
        props: {
            buttonClass: {
                required: false,
                default: 'btn btn-primary',
            },

            label: {
                required: true,
            },

            confirm: {
                required: false,
                default: false,
            },

            action: {
                required: false,
                default: null,
            },

            method: {
                required: false,
                default: null,
            },

            linksTo: {
                required: false,
                default: null,
            },

            formSelector: {
                required: false,
                default: null,
            },
        },

        data: () => ({
            isDisabled: false,
        }),

        methods: {
            click() {
                let self = this;
                self.isDisabled = true;

                if (self.confirm) {
                    self.$toasted.info(self.$trans('global.confirm_action'), {
                        className: 'confirm-action',
                        duration: null,
                        action: [
                            {
                                text: self.$trans('global.confirm'),
                                onClick: (e, toast) => {
                                    toast.goAway(0);
                                    self.perform();
                                },
                            },
                            {
                                text: self.$trans('global.cancel'),
                                onClick: (e, toast) => {
                                    self.isDisabled = false;
                                    toast.goAway(0);
                                },
                            },
                        ],
                        onComplete() {
                            self.isDisabled = false;
                        },
                    });
                } else {
                    self.perform();
                }
            },

            perform() {
                if (this.action) return this.request();

                if (this.linksTo) return this.redirect(this.linksTo);

                return document.querySelector(this.formSelector).submit();
            },

            request() {
                axios[this.method](this.action)
                    .then(res => this.redirect(res.data.redirect))
                    .catch(({ response }) => {
                        this.$toasted.error(response.data.message);
                    });
            },

            redirect(redirect) {
                if (redirect) {
                    window.location.href = redirect;
                }
            },
        },
    };
</script>