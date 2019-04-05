<div class="border-b px-4 py-6">
    <div class="row">
        <div class="col-half">
            <h3 class="text-grey-darkest mb-2">{{ trans('checkout.billing_details') }}</h3>
            <address class="roman mb-6 leading-normal">
                @if($basket->billingDetail->company_name)
                    <strong>{{ $basket->billingDetail->company_name }}</strong>
                    <br>
                @endif
                <strong>{{ $basket->billingDetail->first_name }} {{ $basket->billingDetail->last_name }}</strong><br>
                {{ $basket->billingDetail->street }}<br>
                {{ $basket->billingDetail->zipcode }} {{ $basket->billingDetail->city }}
                <br>
                <strong class="mr5">{{ trans('profiles.phone') }}: </strong>{{ $basket->billingDetail->phone }}
            </address>
        </div>
        <div class="col-half">
            <h3 class="text-grey-darkest mb-2">{{ trans('checkout.shipping_details') }}</h3>
            <address class="roman mb-6  leading-normal">
                @if($basket->shippingDetail->company_name)
                    <strong>{{ $basket->shippingDetail->company_name }}</strong>
                    <br>
                @endif
                <strong>{{ $basket->shippingDetail->first_name }} {{ $basket->shippingDetail->last_name }}</strong><br>
                {{ $basket->shippingDetail->street }}<br>
                {{ $basket->shippingDetail->zipcode }} {{ $basket->shippingDetail->city }}
                <br>
                <strong class="mr5">{{ trans('profiles.phone') }}: </strong>{{ $basket->shippingDetail->phone }}
            </address>
        </div>
        @if($basket->billingDetail->vat_id || $basket->billingDetail->company_id)
            <div class="col-full">
                <div class="flex flex-col">
                    @if($basket->billingDetail->company_id)
                        <strong class="my-1">{{ trans('profiles.company_id') }}: {{ $basket->billingDetail->company_id }}</strong>
                    @endif
                    @if($basket->billingDetail->vat_id)
                        <strong class="my-1">{{ trans('profiles.vat_id') }}: {{ $basket->billingDetail->vat_id }}</strong>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>