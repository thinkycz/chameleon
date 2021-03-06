@extends('layouts.app')

@section('title', getPageTitle(__('basket.confirmation')))

@section('content')
    <div class="container py-16">
        <div class="row">
            <vue-checkout-steps current="confirmation"></vue-checkout-steps>
        </div>
        <form csrf method="post" action="{{ route('checkout.complete') }}" id="complete-checkout">
            <div class="row">
                <div class="col-9 main-basket">
                    <div class="card">
                        @include('confirmation.partials.details')

                        <div class="border-b p-4">
                            <h3>{{ trans('checkout.ordered_items') }}</h3>
                        </div>
                        @foreach($basket->orderedItems as $orderedItem)
                            @include('confirmation.partials.ordered_item')
                        @endforeach
                    </div>
                </div>

                @include('confirmation.partials.sidebar')
            </div>
        </form>
    </div>
@stop