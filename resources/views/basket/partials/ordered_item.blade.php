<div class="basket-item flex">
    <div class="image">
        <img src="{{ $orderedItem->product->thumb }}">
    </div>
    <div class="name">
        <p class="p-big">
            <a href="{{ route('products.show', $orderedItem->product) }}" class="text-grey-darkest">{{ $orderedItem->product->name }}</a>
        </p>
        <p class="p-small">
            @if($orderedItem->product->barcode)
                <span><strong class="mr-1">EAN</strong>{{ $orderedItem->product->barcode }}</span>
            @elseif($orderedItem->product->catalogue_number)
                <span><strong class="mr-1">CAT</strong>{{ $orderedItem->product->catalogue_number }}</span>
            @endif
        </p>
    </div>
    <div class="ordered">
        <p class="text-xl text-primary mb-0 font-bold">{{ $orderedItem->formatted_price }}</p>
        <p class="text-sm text-grey-darker mb-2">{{ $orderedItem->formatted_price_excl_vat . ' ' . trans('products.excl_vat') }}</p>
    </div>

    <vue-basket-item-quantity :item="{{ json_encode($orderedItem) }}" has-error="{{ $errors->has('quantities-' . $orderedItem->id) }}"></vue-basket-item-quantity>

    <div class="total text-right">
        <p class="text-xl text-primary mb-0 font-bold">{{ $orderedItem->formatted_total_price }}</p>
        <p class="text-sm text-grey-darker mb-2">{{ $orderedItem->formatted_total_price_excl_vat . ' ' . trans('products.excl_vat') }}</p>
    </div>
</div>
