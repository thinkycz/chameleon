<template>
    <div class="pb-1">
        <div class="input-wrap mb-2 -mx-2">
            <div class="radio">
                <input type="radio"
                    id="shipping_detail_same"
                    :value="true"
                    name="shipping_detail"
                    v-model="same">
                <label for="shipping_detail_same"
                    class="radio-label">{{ $trans('checkout.ship_to_billing') }}</label>
            </div>
        </div>
        <div class="input-wrap -mx-2">
            <div class="radio">
                <input type="radio"
                    id="shipping_detail_diff"
                    :value="false"
                    name="shipping_detail"
                    v-model="same">
                <label for="shipping_detail_diff"
                    class="radio-label">{{ $trans('checkout.ship_to_different') }}</label>
            </div>
        </div>

        <div v-if="!same">
            <slot></slot>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                same: true,
            };
        },
    };
</script>