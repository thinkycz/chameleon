@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            @if($basket->orderedItems->isNotEmpty())
                <vue-checkout-steps current="basket"></vue-checkout-steps>
            @endif
        </div>
        <div class="row">
            @if($basket->orderedItems->isNotEmpty())
                <div class="col-9 main-basket">
                    <div class="card">
                        @foreach($basket->orderedItems as $orderedItem)
                            @include('basket.partials.ordered_item')
                        @endforeach
                    </div>
                </div>
                <vue-basket-sidebar>
                    <div class="inner">
                        <div class="card">
                            @include('basket.partials.sidebar')
                        </div>
                    </div>
                </vue-basket-sidebar>
            @else
                @include('basket.partials.empty_basket')
            @endif
        </div>
    </div>
@stop