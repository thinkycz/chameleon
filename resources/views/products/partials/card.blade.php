<div class="card product-card">
    <div class="product-image">
        <a href="{{ route('products.show', $product) }}"><img src="{{ $product->thumbnail }}" alt="{{ $product->name }}"></a>
        @if(!$product->availability_or_default->allow_orders)
            <span class="badge text-xs danger">{{ $product->availability_or_default->name }}</span>
        @endif
    </div>

    <div class="product-data">
        <h3><a href="{{ route('products.show', $product) }}">{{ $product->name }}</a></h3>
    </div>

    @if(currentUser()->is_active)
        <div class="product-price">
            <p class="price">{{ $product->formatted_price }}</p>
            <p class="price-excl-vat">{{ trans('products.price_excl_vat', ['price' => $product->formatted_price_excl_vat, 'vat' => $product->formatted_vatrate]) }}</p>
        </div>
    @endif

    <div class="product-stock">
        <span class="icon-wrap mb-4">
            <icon-cubes></icon-cubes>
            <span>{!! trans('products.in_stock_unit', ['unit' => $product->unit_or_default->abbr, 'stock' => $product->public_stock_quantity]) !!}</span>
        </span>

        <span class="icon-wrap">
            <icon-cart></icon-cart>
            <span>{!! trans('products.buy_at_least', ['moq' => $product->minimum_order_quantity, 'unit' => $product->unit_or_default->abbr]) !!}</span>
        </span>
    </div>

    @if(currentUser()->is_active)
        <vue-add-to-basket :product="{{ json_encode($product) }}"
                :purchasable="{{ booleanToString($product->purchasable) }}"
        ></vue-add-to-basket>
    @endif

</div>