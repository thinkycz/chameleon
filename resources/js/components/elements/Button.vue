<template>
    <button role="button"
        :class="buttonClass"
        :disabled="isDisabled"
        @click.stop.prevent="click">
        {{ label }}
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
        },

        data: () => ({
            isDisabled: false,
        }),

        methods: {
            click() {
                let self = this;
                this.isDisabled = true;

                if (this.confirm) {
                    this.$toasted.info(self.$trans('global.confirm_action'), {
                        className: 'confirm-action',
                        duration: 12000,
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
                axios[this.method](this.action)
                    .then(res => this.requestCallback(res.data.redirect))
                    .catch(({ response }) => {
                        this.$toasted.error(response.data.message);
                    });
            },

            requestCallback(redirect) {
                if (redirect) {
                    window.location.href = redirect;
                }
            },
        },
    };
</script>