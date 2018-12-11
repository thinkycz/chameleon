<div class="card product-card">
    <div class="product-image">
        <img src="{{ $product->thumb }}">
    </div>
    <div class="product-data">
        <span class="badge accent">{{ optional($product->availability)->name }}</span>
        <h3>{{ $product->name }}</h3>
        <p class="product-price">{{ $product->formatted_price }}</p>
    </div>
    <div class="product-actions">
        <!-- TODO:: change -->
        <form method="post" csrf form-action="products.add_to_basket" params="$product">
            <button type="submit" class="btn btn-primary">Add to Basket</button>
        </form>
    </div>
</div>