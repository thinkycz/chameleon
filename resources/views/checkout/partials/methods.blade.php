<div class="card p-4">
    <div class="row">
        <div class="col-12 mb-6">
            <h3 class="text-grey-darkest mb-2">{{ trans('checkout.delivery_method') }}</h3>

            @foreach($deliveryMethods as $deliveryMethod)
                @include('checkout.partials.delivery_method')
            @endforeach
        </div>

        <div class="col-12">
            <h3 class="text-grey-darkest mb-2">{{ trans('checkout.payment_method') }}</h3>

            @foreach($paymentMethods as $paymentMethod)
                @include('checkout.partials.payment_method')
            @endforeach
        </div>


        <div class="col-12 my-4">
            <hr class="border-t">
        </div>

        <div class="col-12 mb-2">
            <h3 class="text-grey-darkest mb-2">{{ trans('checkout.additional_notes') }}</h3>
            <p>{{ trans('checkout.additional_information_note') }}</p>
            <div class="input-wrap">
                <label for="customer_notes">{{ trans('checkout.notes') }}</label>
                <textarea id="customer_notes" class="input" name="customer_notes" value="{{ old('customer_notes') }}" placeholder="{{ trans('checkout.write_your_notes_here') }}"></textarea>
            </div>
        </div>

        <div class="col-12 text-right">
            <button type="submit" class="btn btn-primary btn-lg">{{ trans('checkout.confirmation') }}</button>
        </div>
    </div>
</div>