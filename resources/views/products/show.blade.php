@extends('layouts.app')

@section('content')
    <!-- TODO:: Add related products, add details card -->
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        <div class="row">
            <div class="col-full mx-auto">
                <div class="card flex justify-between p-4">

                    @if($product->images->isNotEmpty())
                        <vue-product-gallery :images="{{ $product->images }}"></vue-product-gallery>
                    @endif

                    @include('products.partials.details')

                </div>
            </div>
        </div>

        @includeWhen($relatedProducts->count(), 'products.partials.related')

    </div>
@stop

@section('footer')
    <portal-target name="details-modal"></portal-target>
@endsection