<template>
    <div class="relative col-search"
        v-click-outside="closeOverlay">
        <div class="search-wrapper">
            <form :action="route"
                id="search-form">
                <div class="search-wrap input-wrap has-icon z-75"
                    @click.prevent.stop="overlay = true">
                    <icon-search @click.prevent.stop="submitForm"></icon-search>
                    <input type="text"
                        class="input"
                        name="query"
                        autocomplete="off"
                        v-model="currentQuery"
                        @keydown.enter="submitForm"
                        :placeholder="$trans('header.what_are_you_looking')">
                </div>
            </form>
        </div>
        <suggestions :show="showOverlay"
            :show-prices="eligibleToSeePrices"
            :query="currentQuery">
            <slot></slot>
        </suggestions>
        <div class="search-overlay"
            :class="{'show': showOverlay}"
            @click.prevent.stop="overlay = false">
        </div>
    </div>
</template>

<script>
    import Suggestions from './Suggestions';
    import { ClickOutside } from './../../directives/ClickOutside';

    export default {
        props: {
            eligibleToSeePrices: {
                required: true,
                default: false,
            },
            route: String,
            query: String,
            modifier: String,
        },

        data() {
            return {
                currentQuery: this.query,
                overlay: false,
            };
        },

        computed: {
            showOverlay() {
                return this.overlay && this.currentQuery.length > 0;
            },
        },

        methods: {
            closeOverlay() {
                if (this.overlay) {
                    this.overlay = false;
                }
            },

            submitForm() {
                document.getElementById('search-form').submit();
            },
        },

        components: {
            Suggestions,
        },

        directives: {
            ClickOutside,
        },
    };
</script>
