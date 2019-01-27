<div class="row mt-12">
    <div class="col-full">
        <h2 class="text-2xl text-grey-darkest mb-4">{{ trans('products.related_products') }}</h2>
    </div>
    @foreach($relatedProducts as $product)
        <div class="col-product">
            @include('products.partials.card')
        </div>
    @endforeach
</div>