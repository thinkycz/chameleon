<div class="basket-sidebar-content p-4">
    <div class="flex justify-between items-center">
        <p class="mb-0 text-xl">{{ trans('basket.total') }}:</p>
        <p class="mb-0 font-bold text-xl text-primary">{{ $basket->formatted_total_price }}</p>
    </div>
    <div class="text-right">
        <p class="text-sm text-grey-darker">{{ $basket->formatted_total_price . ' ' . trans('products.excl_vat') }}</p>
    </div>
    <div class="quantities mb-6">
        <p class="mb-2 text-center"><a href="#" class="btn btn-accent text-center">{{ trans('basket.update_quantities') }}</a></p>
        <p class="text-center text-sm"><a href="#" class="text-danger">{{ trans('basket.empty_basket') }}</a></p>
    </div>
    <div class="delivery-method mb-4">
        <h4 class="text-grey-darker text-sm uppercase mb-2">{{ trans('basket.delivery_method') }}</h4>

        @foreach($deliveryMethods as $deliveryMethod)
            @include('basket.partials.delivery_method')
        @endforeach
    </div>
    <div class="payment-method mb-6">
        <h4 class="text-grey-darker text-sm uppercase mb-2">{{ trans('basket.payment_method') }}</h4>

        @foreach($paymentMethods as $paymentMethod)
            @include('basket.partials.payment_method')
        @endforeach
    </div>
    <p><a href="#" class="btn btn-primary w-full text-center">{{ trans('basket.checkout') }}</a></p>
</div>