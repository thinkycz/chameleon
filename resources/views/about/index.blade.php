@extends('layouts.app')

@section('title', getPageTitle(__('footer.about')))

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        @include('about.partials.about')

        @include('about.partials.boxes')

    </div>
@stop