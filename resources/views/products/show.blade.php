@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            <div class="col-half">
                <div class="card">
                    @if($product->images->isNotEmpty())
                        <vue-product-gallery :images="{{ $product->images }}"></vue-product-gallery>
                    @else
                        <!-- TODO:: blank image -->
                    @endif
                </div>
            </div>
            <div class="col-half">

            </div>
        </div>
    </div>
@stop