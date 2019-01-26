<template>
    <div class="input-wrap mr-4"
        style="margin-bottom: 0;">
        <div class="checkbox">
            <input type="checkbox"
                :id="id"
                :name="name"
                :checked="checked"
                @chage="changed">
            <label :for="id"
                class="checkbox-label"
                @click="select">{{ label }}</label>
        </div>
    </div>
</template>

<script>
    const queryString = require('query-string');

    export default {
        props: {
            id: {
                required: true,
            },

            name: {
                required: true,
            },

            label: {
                required: true,
            },

            isChecked: {
                required: true,
                default: 0,
            },
        },

        data: () => ({
            checked: 0,
        }),

        methods: {
            select() {
                let parsed = queryString.parse(window.location.search);

                this.checked = !this.checked;

                parsed[this.name] = this.checked ? 1 : 0;
                parsed.page = 1;

                window.location.search = queryString.stringify(parsed);
            },

            changed() {
                //
            },
        },

        created() {
            this.checked = this.isChecked || 0;
        },
    };
</script>
