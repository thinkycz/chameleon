<template>
    <div class="row mt-6">
        <div class="col-full">
            <div class="card profile-sections">
                <div class="profile-header">
                    <a href="#!"
                        v-for="partial in partials"
                        :key="partial"
                        @click.prevent="change(partial)"
                        :class="{'active': partial == component}"
                        v-html="$trans(`profiles.${partial}`)"></a>
                </div>
                <transition name="fade"
                    mode="out-in">
                    <div class="profile-body"
                        v-for="partial in partials"
                        :key="partial"
                        v-if="component == partial">
                        <slot :name="partial"></slot>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            current: {
                required: true,
                default: 'overview',
            },
        },

        data() {
            return {
                component: this.current,
                partials: ['account_overview', 'account_details', 'address_book', 'account_privacy'],
            };
        },

        methods: {
            change(component) {
                window.updateQueryStringParam('current', component);
                this.component = component;
            },
        },
    };
</script>
