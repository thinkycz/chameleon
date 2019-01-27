<div class="product-details">
    <h2 class="mb-2">{{ $product->name }}</h2>

    <p class="text-sm mb-3 text-grey-darker">
        @if($product->barcode)
            <span class="mr-4">{{ trans('products.barcode') }}<strong class="ml-1">{{ $product->barcode }}</strong></span>
        @endif
        @if($product->catalogue_number)
            <span>{{ trans('products.catalogue_number') }}<strong class="ml-1">{{ $product->catalogue_number }}</strong></span>
        @endif
    </p>

    @if($product->tags->isNotEmpty())
        <p class="mb-8 flex flex-wrap">
            @foreach($product->tags as $tag)
                @include('partials.tag')
            @endforeach
        </p>
    @endif

    <p>{{ $product->description }}</p>

    @include('products.partials.pricing')

    @include('products.partials.stock')

</div>