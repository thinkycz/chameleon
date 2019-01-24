@extends('layouts.app')

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
                            @foreach($basket->orderedItems as $orderedItem)
                                @include('basket.partials.ordered_item')
                            @endforeach
                        </div>
                    </div>
                    <vue-affixsidebar>
                        <div class="inner">
                            <div class="card">
                                @include('basket.partials.sidebar')
                            </div>
                        </div>
                    </vue-affixsidebar>
                @else
                    @include('basket.partials.empty_basket')
                @endif
            </div>
        </form>
    </div>
@stop