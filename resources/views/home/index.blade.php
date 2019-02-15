@extends('layouts.app')

@section('content')
    @include('home.partials.hero')
    @includeWhen($categories->isNotEmpty(), 'home.partials.categories')
    @includeWhen($firstCategory, 'home.partials.category', ['category' => $firstCategory])
    @includeWhen($secondCategory, 'home.partials.category', ['category' => $secondCategory])

    @auth
        @includeWhen($homepage['banner_heading'], 'home.partials.banner')
    @else
        @include('home.partials.auth_banner')
    @endauth
@stop