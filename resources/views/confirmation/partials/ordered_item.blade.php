<div class="basket-item flex">
    <div class="image">
        <img src="{{ $orderedItem->product->thumbnail }}">
    </div>
    <div class="name">
        <p class="p-big">
            <a href="{{ route('products.show', $orderedItem->product) }}" class="text-grey-darkest">{{ $orderedItem->product->name }}</a>
        </p>
    </div>
    <div class="ordered">
        <p class="text-xl text-primary mb-0 font-bold">{{ $orderedItem->formatted_price }}</p>
        <p class="text-sm text-grey-darker mb-2">{{ $orderedItem->formatted_price_excl_vat . ' ' . trans('products.excl_vat') }}</p>
    </div>

    <div>
        <p class="p-small">
            @if($orderedItem->product->barcode)
                <span class="mr-4">{{ trans('products.barcode') }}<strong class="ml-1">{{ $orderedItem->product->barcode }}</strong></span>
            @endif
            @if($orderedItem->product->catalogue_number)
                <span>{{ trans('products.catalogue_number') }}<strong class="ml-1">{{ $orderedItem->product->catalogue_number }}</strong></span>
            @endif
        </p>
    </div>

    <div class="total text-right">
        <p class="text-xl text-primary mb-0 font-bold">{{ $orderedItem->formatted_total_price }}</p>
        <p class="text-sm text-grey-darker mb-2">{{ $orderedItem->formatted_total_price_excl_vat . ' ' . trans('products.excl_vat') }}</p>
    </div>
</div>
