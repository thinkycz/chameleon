@if($product->images->isNotEmpty())
    <vue-product-gallery :images="{{ $product->images }}"></vue-product-gallery>
@else
    <div class="product-gallery">
        <div class="preview">
            <img src="{{ placeholderImage() }}" alt="{{ $product->slug }}">
        </div>
    </div>
@endif