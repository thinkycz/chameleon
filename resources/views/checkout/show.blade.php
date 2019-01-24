@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            @if($basket->hasOrderedItems())
                <vue-checkout-steps current="checkout"></vue-checkout-steps>
            @endif
        </div>
        <div class="row">
            <div class="col-full">
                @include('partials.errors')
            </div>
            <div class="col-6">
                @include('checkout.partials.details')
            </div>
            <div class="col-6">
                @include('checkout.partials.methods')
            </div>
        </div>
    </div>


@stop

@section('footer')
    <portal-target name="address-modal"></portal-target>
@endsection