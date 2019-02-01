@auth
    <div class="product-pricing">
        <h3 class="text-primary tracking-tight font-semibold text-4xl">{{ $product->formatted_price }}</h3>
        <p class="text-sm text-grey-darker font-semibold mb-0">{{ trans('products.price_excl_vat', ['price' => $product->formatted_price_excl_vat, 'vat' => $product->formatted_vatrate]) }}</p>
    </div>
@else
    <div class="product-pricing">
        <div class="alert primary mt-5">
            <span class="icon-wrap icon-2x">
                <icon-infocircle></icon-infocircle>
                <p class="mb-0">{!! trans('products.login_to_view_details', ['login' => route('login'), 'register' => route('register')]) !!}</p>
            </span>
        </div>
    </div>
@endauth