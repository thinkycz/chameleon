@extends('layouts.app')

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        @include('about.partials.about')

        @include('about.partials.boxes')

    </div>
@stop