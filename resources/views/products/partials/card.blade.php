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
    <div class="product-actions">
        <!-- TODO:: change -->
        <form method="post" csrf form-action="products.add_to_basket" params="$product">
            <button type="submit" class="btn btn-primary icon-wrap mx-auto uppercase text-xs">{{ trans('products.add_to_basket') }} <span class="icon-wrapped"><icon-cart></icon-cart></span></button>
        </form>
    </div>
</div>