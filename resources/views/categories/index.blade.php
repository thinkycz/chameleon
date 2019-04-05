@extends('layouts.app')

@section('title', getPageTitle(__('home.all_categories')))

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        <div class="row">
            @forelse($categories as $category)
                <div class="col-category">
                    @include('categories.partials.card')
                </div>
            @empty
                @include('partials.no_results_found')
            @endforelse
        </div>

    </div>
@stop