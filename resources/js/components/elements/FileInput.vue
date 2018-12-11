<template>
    <div class="input-wrap flex mt-2">
        <input type="file"
            :name="inputName"
            class="absolute pin-t pin-l w-full opacity-0 h-full z-20 cursor-pointer"
            @change="handleOnChange($event)"
            :accept="acceptedTypes" />
        <span class="btn btn-primary shadow btn-sm z-10 whitespace-no-wrap">{{ buttonLabel }}</span>
        <span class="rounded bg-white shadow block border pl-8 -ml-6 w-full truncate h-8 text-grey-500 text-sm leading-loose">{{ label }}</span>
    </div>
</template>

<script>
    export default {
        props: {
            inputName: {
                required: false,
                default: 'image',
            },
            buttonLabel: {
                required: false,
                default: window.trans('profiles.select_image'),
            },
            inputLabel: {
                required: false,
                default: window.trans('profiles.no_image_selected_yet'),
            },
            acceptedTypes: {
                required: false,
                default: 'image/*',
            },
        },
        data() {
            return {
                image: '',
            };
        },
        computed: {
            label() {
                return this.image ? this.image : this.inputLabel;
            },
        },
        methods: {
            handleOnChange(e) {
                const el = this.$el.querySelector('[type="file"]');
                this.image = el.value ? el.value.replace(/^.*[\\\/]/, '') : '';
            },
        },
    };
</script>