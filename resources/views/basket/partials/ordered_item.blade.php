<div class="basket-item flex border-b">
    <div class="image">
        <img src="{{ $orderedItem->product->thumb }}">
    </div>
    <div class="name">
        <p class="p-big">{{ $orderedItem->product->name }}</p>
        <p class="p-small">{{ str_limit($orderedItem->product->description, 45) }}</p>
        <p class="p-small">
            @if($orderedItem->product->barcode)
                <span class="mr-4">{{ trans('products.barcode') }}<strong class="ml-1">{{ $orderedItem->product->barcode }}</strong></span>
            @endif
            @if($orderedItem->product->catalogue_number)
                <span>{{ trans('products.catalogue_number') }}<strong class="ml-1">{{ $orderedItem->product->catalogue_number }}</strong></span>
            @endif
        </p>
    </div>
    <div class="ordered">
        <p class="text-xl text-primary mb-0 font-bold">{{ $orderedItem->formatted_price }}</p>
        <p class="text-sm text-grey-darker mb-2">{{ $orderedItem->formatted_price_excl_vat . ' ' . trans('products.excl_vat') }}</p>
    </div>

    <vue-basket-item-quantity :item="{{ json_encode($orderedItem) }}"></vue-basket-item-quantity>

    <div class="total text-right">
        <p class="text-xl text-primary mb-0 font-bold">{{ $orderedItem->formatted_total_price }}</p>
        <p class="text-sm text-grey-darker mb-2">{{ $orderedItem->formatted_total_price_excl_vat . ' ' . trans('products.excl_vat') }}</p>
    </div>
</div>
