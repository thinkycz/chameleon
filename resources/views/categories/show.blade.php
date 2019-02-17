@extends('layouts.app')

@section('title', getPageTitle($category->name))

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        @include('categories.partials.filters')

        <div class="row">
            @forelse($products as $product)
                <div class="col-product">
                    @include('products.partials.card')
                </div>
            @empty
                @include('partials.no_results_found')
            @endforelse
        </div>

    </div>
@stop