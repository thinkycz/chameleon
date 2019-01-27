@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            <div class="col-full">
                @include('search.partials.filters')
            </div>
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