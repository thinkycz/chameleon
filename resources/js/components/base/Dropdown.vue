<template>
    <div class="dropdown"
        @click.stop="toggle">

        <button type="button"
            class="btn-text btn-primary has-dropdown"
            @click.prevent.stop="visible = !visible">
            {{ currentLabel }}
        </button>

        <transition name="fade">
            <div class="dropdown-menu"
                v-if="visible"
                v-click-outside="close"
                @click.stop="blank">
                <icon-dropdown></icon-dropdown>
                <ul class="list-reset">
                    <li v-for="(option, index) in options"
                        :key="'option-' + index">
                        <a href="#"
                            @click.prevent="selected($event)"
                            :class="{'text-primary': current == option.value}"
                            :data-value="option.value">{{ option.label }}
                        </a>
                    </li>
                </ul>
            </div>
        </transition>

    </div>
</template>

<script>
    const queryString = require('query-string');
    import { DropdownMixin } from './../../mixins/dropdown';

    export default {
        props: {
            options: {
                required: true,
            },

            label: {
                required: false,
            },

            name: {
                required: true,
            },

            page: {
                required: false,
                default: true,
            },
        },

        computed: {
            current() {
                let parsed = queryString.parse(window.location.search);

                return parsed[this.name] || '';
            },

            currentLabel() {
                if (!this.current) {
                    return this.label;
                }

                let index = this.options.findIndex(option => {
                    return option.value == this.current;
                });

                return this.options[index].label;
            },
        },

        methods: {
            selected(event) {
                this.visible = false;

                let parsed = queryString.parse(window.location.search);

                parsed[this.name] = event.target.dataset.value;

                if (this.page) {
                    parsed.page = 1;
                }

                window.location.search = queryString.stringify(parsed);
            },
        },

        mixins: [DropdownMixin],
    };
</script>