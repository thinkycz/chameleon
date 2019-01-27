<template>
    <div class="col-full">
        <div class="input-wrap has-addon mr-4 inline-block"
            style="margin-bottom: 0">
            <input type="number"
                class="input input-sm"
                step="0.01"
                min="0"
                v-model="min"
                :placeholder="$trans('filters.price_min')">
            <span class="addon">
                <span>{{ currency }}</span>
            </span>
        </div>
        <div class="input-wrap has-addon mr-4  inline-block"
            style="margin-bottom: 0">
            <input type="number"
                class="input input-sm"
                step="0.01"
                min="0"
                v-model="max"
                :placeholder="$trans('filters.price_max')">
            <span class="addon">
                <span>{{ currency }}</span>
            </span>
        </div>
        <button role="button"
            type="button"
            class="btn btn-sm btn-primary"
            @click="filter">{{ $trans('filters.filter_by_price') }}</button>
    </div>
</template>

<script>
    const queryString = require('query-string');

    export default {
        props: {
            currency: {
                required: true,
            },

            currentMin: {
                required: true,
                default: null,
            },

            currentMax: {
                required: true,
                default: null,
            },
        },

        data: () => ({
            min: '',
            max: '',
        }),

        methods: {
            filter() {
                let parsed = queryString.parse(window.location.search);

                parsed.price_min = this.min && this.max ? Math.min(this.min, this.max) : this.min;
                parsed.price_max = this.min && this.max ? Math.max(this.min, this.max) : this.max;
                parsed.page = 1;

                window.location.search = queryString.stringify(parsed);
            },
        },

        created() {
            this.min = this.currentMin;
            this.max = this.currentMax;
        },
    };
</script>