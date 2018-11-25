<template>
    <div class="dropdown"
        :class="{'active': dropdownIsVisible}">
        <p style="height: 200px"></p>
        <slot></slot>
    </div>
</template>

<script>
    export default {
        props: {
            toggler: String,
        },
        data() {
            return {
                dropdownIsVisible: false,
            };
        },
        methods: {
            toggleDropdown(e) {
                e.preventDefault();
                this.dropdownIsVisible = !this.dropdownIsVisible;
            },
        },
        mounted() {
            document.querySelector(this.toggler).addEventListener('click', this.toggleDropdown);
        },
        beforeDestroy() {
            document.querySelector(this.toggler).removeEventListener('click', this.toggleDropdown);
        },
    };
</script>