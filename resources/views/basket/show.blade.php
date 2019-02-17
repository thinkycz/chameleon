@extends('layouts.app')

@section('title', getPageTitle(__('basket.basket')))

@section('content')
    <div class="container py-16">
        <div class="row">
            @if($basket->hasOrderedItems())
                <vue-checkout-steps current="basket"></vue-checkout-steps>
            @endif
        </div>
        <form id="update-quantities" csrf action="{{ route('basket.quantities.update') }}" method="post" class="w-full relative">
            <div class="row">
                @if($basket->hasOrderedItems())
                    <div class="col-9 main-basket">
                        <div class="card">
                            @each('basket.partials.ordered_item', $basket->orderedItems, 'orderedItem')
                        </div>
                    </div>

                    @include('basket.partials.sidebar')
                @else
                    @include('basket.partials.empty_basket')
                @endif
            </div>
        </form>
    </div>
@stop