@extends('layouts.app')

@section('title', getPageTitle(__('basket.checkout')))

@section('content')
    <div class="container py-16">
        <div class="row">
            @if($basket->hasOrderedItems())
                <vue-checkout-steps current="checkout"></vue-checkout-steps>
            @endif
        </div>
        <form csrf method="post" action="{{ route('checkout.confirm') }}">
            <div class="row">
                <div class="col-full">
                    @include('partials.errors')
                </div>
                <div class="col-half">
                    @include('checkout.partials.details')
                </div>
                <div class="col-half">
                    @include('checkout.partials.methods')
                </div>
            </div>
        </form>
    </div>
@stop

@section('footer')
    <portal-target name="address-modal"></portal-target>
@endsection