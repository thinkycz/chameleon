@extends('layouts.app')

@section('content')
    <!-- TODO:: Add related products, add details card -->

    <div class="container py-16">
        <div class="row">
            <div class="col-10 mx-auto">
                <div class="card flex justify-between p-4">

                    @if($product->images->isNotEmpty())
                        <vue-product-gallery :images="{{ $product->images }}"></vue-product-gallery>
                    @endif

                    <div class="product-details">
                        <h2 class="mb-2">{{ $product->name }}</h2>

                        <p class="text-sm mb-3 text-grey-darker">
                            @if($product->barcode)
                                <span class="mr-4">{{ trans('products.barcode') }}<strong class="ml-1">{{ $product->barcode }}</strong></span>
                            @endif
                            @if($product->catalogue_number)
                                <span>{{ trans('products.catalogue_number') }}<strong class="ml-1">{{ $product->catalogue_number }}</strong></span>
                            @endif
                        </p>

                        <p class="mb-8 flex flex-wrap">
                            @foreach($product->tags as $tag)
                                @include('partials.tag')
                            @endforeach
                        </p>

                        <p>{{ $product->description }}</p>

                        @auth
                        <div class="product-pricing">
                            <h3 class="text-primary tracking-tight font-bold text-4xl">{{ $product->formatted_price }}</h3>
                            <p class="text-sm text-grey-darker mb-0">{{ $product->formatted_price_excl_vat . ' ' . trans('products.excl_vat') }}</p>
                        </div>
                        @else
                        <div class="product-pricing">
                            <!-- TODO:: implement -->
                        </div>
                        @endauth

                        <div class="product-stock mt-4 text-sm">

                            @auth
                                <vue-add-to-basket :is-mini="false" :product="{{ json_encode($product) }}"></vue-add-to-basket>
                            @else
                                <!-- TODO:: implement -->
                            @endauth

                            <span class="icon-wrap">
                                <icon-cubes></icon-cubes>
                                <span>{!! trans('products.in_stock_moq', [
                                    'unit' => strtolower(optional($product->unit)->name),
                                    'moq' => $product->minimum_order_quantity,
                                    'stock' => $product->quantity_in_stock
                                    ]) !!}
                                </span>
                            </span>

                            <span class="icon-wrap mt-2">
                                <!-- TODO:: real numbers -->
                                <icon-circlecheck></icon-circlecheck>
                                <span>{!! trans('products.total_times_ordered', [
                                    'total' => random_int(5, 100),
                                    ]) !!}</span>
                            </span>

                            <div class="alert accent mt-5">
                                <span class="icon-wrap">
                                    <icon-cube></icon-cube>
                                    <p class="mb-0">{!! trans('products.this_product_is_stock', ['stock' => optional($product->availability)->name]) !!}</p>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop