<div class="card p-4">
    <div class="row -mt-4">
        <div class="col-12 my-4">
            <h2 class="font-normal text-grey-darkest mb-2">{{ trans('checkout.contact_information') }}</h2>
            <p>{{ trans('checkout.email_address_note') }}</p>

            <div class="input-wrap">
                <label for="email">{{ trans('auth.email') }}*</label>
                <input type="email" id="email" name="email" required class="input" value="{{ old('email', currentUser()->email) }}" placeholder="{{ trans('auth.your_email') }}">
            </div>
            <div class="input-wrap">
                <label for="phone">{{ trans('profiles.phone') }}*</label>
                <input type="text" id="phone" required class="input" name="phone" value="{{ old('phone', currentUser()->phone) }}" placeholder="{{ trans('profiles.phone_label') }}">
            </div>
        </div>

        <vue-checkout-address-wrapper :addresses="{{ json_encode($addresses) }}" inline-template>
            <div class="col-12 my-4">
                <h2 class="font-normal text-grey-darkest mb-4">{{ trans('checkout.billing_and_shipping_details') }}</h2>

                <template v-if="addresses.length">
                    <vue-checkout-address-selector name="billing_detail_id"></vue-checkout-address-selector>

                    <vue-checkout-shipping-details>
                        <div class="w-full">
                            <vue-checkout-address-selector name="shipping_detail_id" />
                        </div>
                    </vue-checkout-shipping-details>
                </template>

                <div class="alert primary mt-2 mb-4" v-else>
                    <span class="icon-wrap icon-2x">
                        <icon-infocircle></icon-infocircle>
                        <p class="mb-0">{{ trans('checkout.addresses_empty') }}</p>
                    </span>
                </div>
            </div>
        </vue-checkout-address-wrapper>

        <div class="col-12">
            <vue-modaltrigger modal="address-modal" label="&plus; {{ trans('checkout.add_new_address') }}" :button="false">
                @include('checkout.partials.address_form')
            </vue-modaltrigger>
        </div>
    </div>
</div>