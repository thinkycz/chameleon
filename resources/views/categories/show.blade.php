@extends('layouts.app')

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        @include('categories.partials.filters')

        <div class="row">
            @foreach($products as $product)
                <div class="col-product">
                    @include('products.partials.card')
                </div>
            @endforeach
        </div>

    </div>
@stop