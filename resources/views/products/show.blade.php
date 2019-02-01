@extends('layouts.app')

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        <div class="row">
            <div class="col-full mx-auto">
                <div class="card md:flex justify-between p-4">

                    @include('products.partials.images')

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