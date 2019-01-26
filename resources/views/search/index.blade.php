@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            <div class="col-full">
                @include('search.partials.filters')
            </div>
            @foreach($products as $product)
                <div class="col-product">
                    @include('products.partials.card')
                </div>
            @endforeach
        </div>
    </div>
@stop