<div class="row page-break">
    <div class="col-12">
        <div class="card main-basket">
            <h3 class="mb-2 px-4 pt-4">{{ trans('checkout.order') .' #'. $order->order_number }}</h3>

            @include('invoices.partials.order_details')

            <div class="border-b p-4">
                <h3>{{ trans('checkout.ordered_items') }}</h3>
            </div>
            @foreach($order->orderedItems as $orderedItem)
                @include('invoices.partials.ordered_item')
            @endforeach
        </div>
    </div>
</div>