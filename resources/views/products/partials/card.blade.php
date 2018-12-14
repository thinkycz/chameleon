<div class="card product-card">
    <div class="product-image">
        <img src="{{ $product->thumb }}">
        <span class="badge accent text-xs">{{ optional($product->availability)->name }}</span>
    </div>
    <div class="product-data">
        <h3>{{ $product->name }}</h3>
    </div>
    <div class="product-price">
        <p class="price">{{ $product->formatted_price }}</p>
        <p class="price-excl-vat">{{ $product->formatted_price . ' ' .trans('products.excl_vat') }}</p>
    </div>
    <div class="product-stock">
        <span class="icon-wrap">
            <icon-cubes></icon-cubes>
            <span>{!! trans('products.in_stock_moq', [
                'unit' => strtolower(optional($product->unit)->name),
                'moq' => $product->minimum_order_quantity,
                'stock' => $product->quantity_in_stock
                ]) !!}
            </span>
        </span>
    </div>
    <!-- TODO:: add eligibility -->
    @auth
        <vue-add-to-basket :product="{{ json_encode($product) }}"></vue-add-to-basket>
    @endauth
</div>