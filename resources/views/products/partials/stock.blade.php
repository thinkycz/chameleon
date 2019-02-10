<div class="product-stock my-5 text-sm">

    <div class="alert my-5 {{ $product->availability_or_default->allow_orders ? 'success' : 'danger' }}">
        <span class="icon-wrap">
            <icon-cube></icon-cube>
            <p class="mb-0">{!! trans('products.this_product_is_stock', ['stock' => $product->availability_or_default->name]) !!}</p>
        </span>
    </div>

    <div class="icon-wrap my-5">
        <icon-cubes></icon-cubes>
        <span>{!! trans('products.in_stock_unit', ['unit' => $product->unit_or_default->abbr, 'stock' => $product->quantity_in_stock]) !!}</span>
    </div>

    <div class="icon-wrap my-5">
        <icon-basket></icon-basket>
        <span>{!! trans('products.buy_at_least', ['unit' => $product->unit_or_default->abbr, 'moq' => $product->minimum_order_quantity]) !!}</span>
    </div>

    @auth
        <div class="icon-wrap my-5">
            <icon-circlecheck></icon-circlecheck>
            <span>{!! trans('products.total_times_ordered', ['total' => $product->orderedItems()->count()]) !!}</span>
        </div>
    @endauth

    @if($product->details)
        <div class="my-5">
            <vue-modaltrigger modal="details-modal" label="{{ trans('products.product_details') }}" :button="false">
                {!! $product->details !!}
                <p class="mt-4 mb-0">
                    <button role="button" type="button" class="btn-text btn-primary close">{{ trans('global.close') }}</button>
                </p>
            </vue-modaltrigger>
        </div>
    @endif

</div>