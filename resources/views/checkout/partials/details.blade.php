<div class="card p-4">
    <div class="row">
        <div class="col-12">
            <h3 class="text-grey-darkest mb-2">{{ trans('checkout.contact_information') }}</h3>
            <p>{{ trans('checkout.email_address_note') }}</p>

            <div class="input-wrap">
                <label for="email">{{ trans('auth.email') }}*</label>
                <input type="email" id="email" name="email" required class="input" value="{{ old('email') }}" placeholder="{{ trans('auth.your_email') }}">
            </div>
        </div>

        <div class="col-12 mt-2 mb-4">
            <hr class="border-t">
        </div>

        <div class="col-12">
            <h3 class="text-grey-darkest mb-4">{{ trans('checkout.billing_and_shipping_details') }}</h3>

            @if($addresses->isNotEmpty())
                <vue-checkout-address-selector
                    name="billing_details_id"
                    :addresses="{{ json_encode($addresses) }}">
                </vue-checkout-address-selector>

                <vue-checkout-shipping-details>
                    <div class="w-full">
                        <vue-checkout-address-selector
                            name="shipping_details_id"
                            :addresses="{{ json_encode($addresses) }}">
                        </vue-checkout-address-selector>
                    </div>
                </vue-checkout-shipping-details>
            @endif
        </div>
        @if($addresses->isEmpty())
            <div class="col-12">
                <div class="alert primary mt-2 mb-4">
                    <span class="icon-wrap icon-2x">
                        <icon-infocircle></icon-infocircle>
                        <p class="mb-0">{{ trans('checkout.addresses_empty') }}</p>
                    </span>
                </div>
            </div>
        @endif
        <div class="col-12">
            <vue-modaltrigger modal="address-modal" label="{{ trans('checkout.add_new_address') }}">
                @include('checkout.partials.address_form')
            </vue-modaltrigger>
        </div>
    </div>
</div>