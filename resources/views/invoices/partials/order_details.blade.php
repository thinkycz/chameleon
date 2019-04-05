<div class="border-b px-4 pt-2 pb-6">
    <div class="row">
        <div class="col-half pb-4">
            <img src="{{ settingsRepository()->getLogo() }}" alt="{{ config('app.name') }}" class="w-32"/>
            <p class="p-big mt-4">{{ trans('checkout.issuer', ['name' => settingsRepository()->getCompanyName()]) }}</p>
            <p class="p-small icon-wrap"><span>{{ settingsRepository()->getCompanyAddress() }}</span></p>
            <p class="p-small icon-wrap"><span>{{ settingsRepository()->getCompanyEmail() }}</span></p>
            <p class="p-small icon-wrap"><span>{{ settingsRepository()->getCompanyPhoneNumber() }}</span></p>
        </div>
        <div class="col-half pb-4">
            <h4>{{ trans('checkout.invoice') }}</h4>
            <p class="text-grey-darkest mb-0">#{{ $order->invoice_number }}</p>
            <p class="text-grey-darkest mb-0">VS {{ $order->variable_symbol }}</p>
            <p class="text-grey-darkest mb-1">{{ trans('checkout.placed_at', ['date' => $order->placed_at->format(config('config.date_format'))]) }}</p>
        </div>
        <div class="w-full mb-4 px-2">
            <hr class="border-t" />
        </div>
        <div class="col-half">
            <h3 class="text-grey-darkest mb-2">{{ trans('checkout.billing_details') }}</h3>
            <address class="roman mb-6 leading-normal">
                @if($order->billingDetail->company_name)
                    <strong>{{ $order->billingDetail->company_name }}</strong>
                    <br>
                @endif
                <strong>{{ $order->billingDetail->first_name }} {{ $order->billingDetail->last_name }}</strong><br>
                {{ $order->billingDetail->street }}<br>
                {{ $order->billingDetail->zipcode }} {{ $order->billingDetail->city }}
                <br>
                <strong class="mr5">{{ trans('profiles.phone') }}: </strong>{{ $order->billingDetail->phone }}
            </address>
        </div>
        <div class="col-half">
            <h3 class="text-grey-darkest mb-2">{{ trans('checkout.shipping_details') }}</h3>
            <address class="roman mb-6  leading-normal">
                @if($order->shippingDetail->company_name)
                    <strong>{{ $order->shippingDetail->company_name }}</strong>
                    <br>
                @endif
                <strong>{{ $order->shippingDetail->first_name }} {{ $order->shippingDetail->last_name }}</strong><br>
                {{ $order->shippingDetail->street }}<br>
                {{ $order->shippingDetail->zipcode }} {{ $order->shippingDetail->city }}
                <br>
                <strong class="mr5">{{ trans('profiles.phone') }}: </strong>{{ $order->shippingDetail->phone }}
            </address>
        </div>
        @if($order->billingDetail->vat_id || $order->billingDetail->company_id)
            <div class="col-full">
                <div class="flex flex-col">
                    @if($order->billingDetail->company_id)
                        <strong class="my-1">{{ trans('profiles.company_id') }}: {{ $order->billingDetail->company_id }}</strong>
                    @endif
                    @if($order->billingDetail->vat_id)
                        <strong class="my-1">{{ trans('profiles.vat_id') }}: {{ $order->billingDetail->vat_id }}</strong>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>