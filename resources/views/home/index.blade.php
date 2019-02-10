@extends('layouts.app')

@section('content')
    @include('home.partials.hero')
    @includeWhen($categories->isNotEmpty(), 'home.partials.categories')
    @includeWhen($firstCategory, 'home.partials.category', ['category' => $firstCategory])
    @includeWhen($homepage['banner_heading'], 'home.partials.banner')
    @includeWhen($secondCategory, 'home.partials.category', ['category' => $secondCategory])
    @includeWhen(!auth()->check(), 'home.partials.auth_banner')
@stop