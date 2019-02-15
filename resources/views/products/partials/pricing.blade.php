@auth
    @if(currentUser()->is_active)
        <div class="lg:flex justify-between items-center">
            <div class="product-pricing mr-10 my-5">
                <h3 class="text-primary tracking-tight font-semibold text-4xl">{{ $product->formatted_price }}</h3>
                <p class="text-sm text-grey-darker font-semibold mb-0">{{ trans('products.price_excl_vat', ['price' => $product->formatted_price_excl_vat, 'vat' => $product->formatted_vatrate]) }}</p>
            </div>

            <div class="product-basket flex-1">
                <vue-add-to-basket :is-mini="false" :product="{{ json_encode($product) }}" :purchasable="{{ booleanToString($product->purchasable) }}"></vue-add-to-basket>
            </div>
        </div>
    @else
        <div class="alert accent mt-5">
            <span class="icon-wrap">
                <icon-circlecheck></icon-circlecheck>
                <p class="mb-0 flex-1">{!! trans('products.waiting_for_activation', ['contactus' => route('contact.index')]) !!}</p>
            </span>
        </div>
    @endif
@else
    <div class="alert primary mt-5">
        <span class="icon-wrap">
            <icon-infocircle></icon-infocircle>
            <p class="mb-0 flex-1">{!! trans('products.login_to_view_details', ['login' => route('login'), 'register' => route('register')]) !!}</p>
        </span>
    </div>
@endauth