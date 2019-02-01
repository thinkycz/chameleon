<div class="product-details py-2 md:mx-5">
    <h2 class="text-3xl font-normal mb-5">{{ $product->name }}</h2>

    <div class="mb-5 text-grey-darker flex justify-between">
        @if($product->catalogue_number)
            <div class="flex">
                <icon-warehouse></icon-warehouse>
                <span class="ml-2">{{ $product->catalogue_number }}</span>
            </div>
        @endif

        @if($product->barcode)
            <div class="flex">
                <icon-barcode></icon-barcode>
                <span class="ml-2">{{ $product->barcode }}</span>
            </div>
        @endif
    </div>

    @if($product->tags->isNotEmpty())
        <p class="mb-8 flex flex-wrap">
            @each('partials.tag', $product->tags, 'tag')
        </p>
    @endif

    <p>{{ $product->description }}</p>

    @include('products.partials.pricing')

    @include('products.partials.stock')

</div>