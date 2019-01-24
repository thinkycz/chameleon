<div class="basket-sidebar-content p-4">
    <div class="flex justify-between items-center">
        <p class="mb-0 text-xl">{{ trans('basket.total') }}:</p>
        <p class="mb-0 font-bold text-xl text-primary">{{ $basket->formatted_total_price }}</p>
    </div>
    <div class="text-right">
        <p class="text-sm text-grey-darker">{{ $basket->formatted_total_price . ' ' . trans('products.excl_vat') }}</p>
    </div>
    <div class="quantities mb-6">
        <p class="mb-2 text-center">
            <button type="submit" class="btn btn-accent text-center">{{ trans('basket.update_quantities') }}</button>
        </p>
        <p class="text-center text-sm mb-2 pb-4 border-b">
            <vue-button method="post"
                action="{{ route('basket.empty_basket') }}"
                :confirm="true"
                label="{{ trans('basket.empty_basket') }}"
                button-class="btn-text btn-danger" >
            </vue-button>
        </p>
    </div>
    <p><a href="{{ route('checkout.show') }}" class="btn btn-primary w-full text-center btn-lg">{{ trans('basket.checkout') }}</a></p>
</div>