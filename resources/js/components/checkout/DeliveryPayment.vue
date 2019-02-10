<template>
    <div class="w-full">
        <div class="col-12 my-4">
            <h2 class="font-normal text-grey-darkest mb-2">{{ $trans('checkout.delivery_method') }}</h2>

            <div class="input-wrap -mx-2"
                v-for="deliveryMethod in deliveryMethods"
                :key="'delivery-method' + deliveryMethod.id">
                <div class="radio">
                    <input type="radio"
                        :id="`delivery_method_${deliveryMethod.id}`"
                        :value="deliveryMethod.id"
                        v-model="selectedDelivery"
                        name="delivery_method_id">
                    <label :for="`delivery_method_${deliveryMethod.id}`"
                        class="radio-label text-sm">
                        <span>{{ deliveryMethod.name[locale] }}</span>
                        <span class="inline-block float-right text-primary">{{ deliveryMethod.formatted_price }}</span>
                    </label>
                </div>
            </div>
            <div v-if="$_.isEmpty(deliveryMethods)">
                <span class="text-sm font-semibold">{{ $trans('checkout.no_delivery_methods_available') }}</span>
            </div>
        </div>

        <div class="col-12 my-4">
            <h2 class="font-normal text-grey-darkest mb-2">{{ $trans('checkout.payment_method') }}</h2>

            <div class="input-wrap -mx-2"
                v-for="paymentMethod in paymentMethods"
                :key="'payment-method' + paymentMethod.id">
                <div class="radio">
                    <input type="radio"
                        :id="`payment_method_${paymentMethod.id}`"
                        :value="paymentMethod.id"
                        v-model="selectedPayment"
                        name="payment_method_id">
                    <label :for="`payment_method_${paymentMethod.id}`"
                        class="radio-label text-sm">
                        <span>{{ paymentMethod.name[locale] }}</span>
                        <span class="inline-block float-right text-primary">{{ paymentMethod.formatted_price }}</span>
                    </label>
                </div>
            </div>
            <div v-if="$_.isEmpty(paymentMethods)">
                <span v-if="selectedDelivery"
                    class="text-sm font-semibold text-warning-dark">{{ $trans('checkout.no_payment_methods_available') }}</span>
                <span v-else
                    class="text-sm font-semibold text-warning-dark">{{ $trans('checkout.please_select_delivery_method') }}</span>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            deliveryMethods: { required: true },
            currentDelivery: { default: null },
            currentPayment: { default: null },
        },
        data() {
            return {
                locale: window.currentLocale,
                selectedDelivery: this.currentDelivery,
                selectedPayment: this.currentPayment,
            };
        },
        computed: {
            paymentMethods() {
                if (this.selectedDelivery) {
                    let deliveryMethod = this.deliveryMethods.filter(deliveryMethod => {
                        return deliveryMethod.id == this.selectedDelivery;
                    })[0];

                    return deliveryMethod ? deliveryMethod.available_payment_methods : null;
                }

                return null;
            },
        },
    };
</script>