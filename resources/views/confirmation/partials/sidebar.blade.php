<vue-affixsidebar>
    <div class="inner">
        <div class="card">

            <div class="basket-sidebar-content">
                <div class="p-4">
                    <div class="mb-8">
                        <p class="p-big mb-2">{{ trans('checkout.delivery_method') }}</p>
                        <p class="p-small flex justify-between">
                            <span class="icon-wrap">
                                <icon-cube></icon-cube>&nbsp; <strong>{{ $basket->deliveryMethod->name }}</strong>
                            </span>
                            <span class="ml-2 text-primary">{{ $basket->deliveryMethod->formatted_price }}</span>
                        </p>
                    </div>
                    <div class="my-8">
                        <p class="p-big mb-2">{{ trans('checkout.payment_method') }}</p>
                        <p class="p-small flex justify-between">
                            <span class="icon-wrap">
                                <icon-card></icon-card>&nbsp; <strong>{{ $basket->paymentMethod->name }}</strong>
                            </span>
                            <span class="ml-2 text-primary">{{ $basket->deliveryMethod->formatted_price }}</span>
                        </p>
                    </div>

                    @if($basket->customer_note)
                        <div class="my-8">
                            <p class="p-big mb-2">{{ trans('checkout.additional_notes') }}</p>
                            <p class="p-small">{{ $basket->customer_note }}</p>
                        </div>
                    @endif

                    <div class="flex justify-between items-center">
                        <p class="mb-0 text-xl">{{ trans('basket.total') }}:</p>
                        <p class="mb-0 font-bold text-xl text-primary">{{ $basket->formatted_total_price }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-grey-darker">{{ $basket->formatted_total_price . ' ' . trans('products.excl_vat') }}</p>
                    </div>
                </div>

                <vue-button form-selector="#complete-checkout"
                    label="{{ trans('checkout.complete_order') }}"
                    button-class="btn btn-primary text-center w-full btn-lg rounded-t-none">
                </vue-button>
            </div>

        </div>
    </div>
</vue-affixsidebar>