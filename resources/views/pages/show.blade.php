@extends('layouts.app')

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        <div class="row">
            <div class="col-full mx-auto">
                <div class="card p-4">
                    <div class="mb-8">
                        <h1 class="w-full text-center mb-1 text-grey-darkest tracking-tight">{{ $page->title }}</h1>
                        <p class="p-small mb-8 text-center">{{ trans('pages.created_at', ['date' => $page->formatted_created_at]) }}</p>
                    </div>
                    <div>
                        {!! $page->content !!}
                    </div>
                </div>
            </div>
        </div>

    </div>
@stop