<div class="card p-4">
    <div class="row -mt-4">
        <vue-checkout-delivery-payment :delivery-methods="{{ json_encode($deliveryMethods) }}"
            current-delivery="{{ old('delivery_method_id') }}"
            current-payment="{{ old('payment_method_id') }}">
        </vue-checkout-delivery-payment>

        <div class="col-12 my-4">
            <h2 class="font-normal text-grey-darkest mb-2">{{ trans('checkout.additional_notes') }}</h2>
            <p>{{ trans('checkout.additional_information_note') }}</p>
            <div class="input-wrap">
                <label for="customer_notes">{{ trans('checkout.notes') }}</label>
                <textarea id="customer_notes" class="input" name="customer_notes" value="{{ old('customer_notes') }}" placeholder="{{ trans('checkout.write_your_notes_here') }}"></textarea>
            </div>
        </div>
    </div>
</div>

<div class="my-5 text-right">
    <button type="submit" class="btn btn-primary btn-lg">{{ trans('checkout.confirmation') }}</button>
</div>