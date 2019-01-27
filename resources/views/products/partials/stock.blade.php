<div class="product-stock mt-4 text-sm">
    @auth
        <vue-add-to-basket :is-mini="false" :product="{{ json_encode($product) }}"></vue-add-to-basket>
    @endauth

    <span class="icon-wrap">
        <icon-cubes></icon-cubes>
        <span>{!! trans('products.in_stock_moq', [
            'unit' => strtolower(optional($product->unit)->name),
            'moq' => $product->minimum_order_quantity,
            'stock' => $product->quantity_in_stock
            ]) !!}
        </span>
    </span>

    <span class="icon-wrap mt-2">
        <icon-circlecheck></icon-circlecheck>
        <span>{!! trans('products.total_times_ordered', [
            'total' => $product->orderedItems()->count(),
            ]) !!}</span>
    </span>

    <div class="alert accent mt-5">
        <span class="icon-wrap">
            <icon-cube></icon-cube>
            <p class="mb-0">{!! trans('products.this_product_is_stock', ['stock' => optional($product->availability)->name]) !!}</p>
        </span>
    </div>

    @if($product->details)
    <div class="mt-4">
        <vue-modaltrigger modal="details-modal" label="{{ trans('products.product_details') }}" :button="false">
            {!! $product->details !!}
            <p class="mt-4 mb-0">
                <button role="button" type="button" class="btn-text btn-primary close">{{ trans('global.close') }}</button>
            </p>
        </vue-modaltrigger>
    </div>
    @endif

</div>