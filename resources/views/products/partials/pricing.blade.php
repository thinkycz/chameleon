@auth
    <div class="product-pricing">
        <h3 class="text-primary tracking-tight font-bold text-4xl">{{ $product->formatted_price }}</h3>
        <p class="text-sm text-grey-darker mb-0">{{ $product->formatted_price_excl_vat . ' ' . trans('products.excl_vat') }}</p>
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