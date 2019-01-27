@extends('layouts.app')

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        <div class="row">
            @foreach($categories as $category)
                <div class="col-category">
                    @include('categories.partials.card')
                </div>
            @endforeach
        </div>

    </div>
@stop