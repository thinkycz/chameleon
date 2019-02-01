<div class="card product-card">
    <div class="product-image">
        <a href="{{ route('products.show', $product) }}"><img src="{{ $product->thumb }}" alt="{{ $product->name }}"></a>
        <span class="badge text-xs {{ $product->availability_or_default->allow_orders ? 'success' : 'danger' }}">{{ $product->availability_or_default->name }}</span>
    </div>

    <div class="product-data">
        <h3><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h3>
    </div>

    <div class="product-price">
        <p class="price">{{ $product->formatted_price }}</p>
        <p class="price-excl-vat">{{ trans('products.price_excl_vat', ['price' => $product->formatted_price_excl_vat, 'vat' => $product->formatted_vatrate]) }}</p>
    </div>

    <div class="product-stock">
        <span class="icon-wrap">
            <icon-cubes></icon-cubes>
            <span>{!! trans('products.in_stock_unit', ['unit' => $product->unit_or_default->abbr, 'stock' => $product->public_stock_quantity]) !!}</span>
        </span>
    </div>

    <vue-add-to-basket :product="{{ json_encode($product) }}"
            :purchasable="{{ booleanToString($product->purchasable) }}"
    ></vue-add-to-basket>
</div>