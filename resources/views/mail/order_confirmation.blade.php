@component('mail::message')

# {{ trans('mail.hello') }}

{{  trans('mail.order_placed_header ', ['id' => $order->order_number]) }}

{{  trans('mail.order_placed_details ') }}

@component('mail::panel')
<div class="row">
    <div style="float: left; width: 50%">
      <strong>{{ trans('mail.order_shipping ') }}:</strong>
      <address>
          @if($order->shippingDetail->company_name)
              {{ $order->shippingDetail->company_name }}<br>
          @endif
          {{ $order->shippingDetail->first_name }}&nbsp;{{ $order->shippingDetail->last_name }}<br>
          {{ $order->shippingDetail->street }}<br>
          {{ $order->shippingDetail->zipcode }}&nbsp;{{ $order->shippingDetail->city }}<br>
          {{ optional($order->shippingDetail->country)->name }}<br>
          {!! $order->shippingDetail->phone ? '&#9742;' . $order->shippingDetail->phone : '' !!}
      </address>
  </div>
    <div style="float: left; width: 50%">
      <strong>{{ trans('mail.order_billing ') }}:</strong>
      <address>
          @if($order->billingDetail->company_name)
              {{ $order->billingDetail->company_name }}<br>
          @endif
          {{ $order->billingDetail->first_name }}&nbsp;{{ $order->billingDetail->last_name }}<br>
          {{ $order->billingDetail->street }}<br>
          {{ $order->billingDetail->zipcode }}&nbsp;{{ $order->billingDetail->city }}<br>
          {{ optional($order->billingDetail->country)->name }}<br>
          {!! $order->billingDetail->phone ? '&#9742;' . $order->billingDetail->phone : '' !!}
      </address>
  </div>
</div>
@endcomponent

@if($order->billingDetail->company_id || $order->billingDetail->vat_id)
@component('mail::table')
| {{ trans('mail.company_id') }}    | {{ trans('mail.vat_id') }}       |
|:-------------:|:-------------:|
|{{ $order->billingDetail->company_id }}|{{ $order->billingDetail->vat_id }}|
@endcomponent
@endif

@component('mail::table')
| #             | {{ trans('mail.name') }}          | {{ trans('mail.price') }}    | {{ trans('mail.quantity') }}  | {{ trans('mail.total') }}  |
|:-------------:|:-------------:|:--------:|:---------:|:------:|
@forelse($order->orderedItems as $item)
|{{ $loop->iteration }}|{{ $item->name }}|{{ $item->formatted_price }}|{{ $item->quantity_ordered }}|{{ $item->formatted_total_price }}|
@empty
|{{ trans('mail.order_has_no_products') }} |
@endforelse
<div style="float: right; text-align: right; margin-bottom: 20px;">
    <strong>{{ trans('mail.total_price') }}</strong> {{ $order->formatted_total_price }}
</div>
@endcomponent

@component('mail::button', ['url' => route('profiles.show', ['order' => $order->id])])
{{ __('mail.show_order') }}
@endcomponent

@include('mail.partials.footer')

@endcomponent
