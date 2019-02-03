<vue-affixsidebar>
    <div class="inner">
        <div class="card">
            <div class="basket-sidebar-content">
                <div class="p-4">
                    <div class="flex justify-between items-center">
                        <p class="mb-0 text-xl">{{ trans('basket.total') }}:</p>
                        <p class="mb-0 font-bold text-xl text-primary">{{ $basket->formatted_total_price }}</p>
                    </div>
                    <div class="text-right">
                        <small class="text-sm text-grey-darker">{{ $basket->formatted_total_price . ' ' . trans('products.excl_vat') }}</small>
                    </div>
                </div>

                <div class="text-center">
                    <vue-button form-selector="#update-quantities"
                            label="{{ trans('basket.update_quantities') }}"
                            button-class="btn btn-accent rounded-none w-full">
                    </vue-button>
                    <a href="{{ route('checkout.show') }}" class="btn btn-primary w-full btn-lg rounded-t-none">{{ trans('basket.checkout') }}</a>
                </div>
            </div>
        </div>

        <div class="my-3 text-right text-sm">
            <vue-button method="post"
                    action="{{ route('basket.empty_basket') }}"
                    :confirm="true"
                    label="{{ trans('basket.empty_basket') }}"
                    button-class="btn-text text-grey-darker" >
            </vue-button>
        </div>
    </div>
</vue-affixsidebar>
