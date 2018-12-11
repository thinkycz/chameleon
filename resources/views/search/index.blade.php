@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            @foreach($products as $product)
                <div class="col-third">
                        @include('products.partials.card')
                </div>
            @endforeach
        </div>
    </div>
@stop