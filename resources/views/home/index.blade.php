@extends('layouts.app')

@section('content')
    @includeWhen($categories->isEmpty(), 'home.partials.hero')

    @each('home.partials.category_stripe', $categories, 'category')

    @includeWhen(auth()->guest(), 'home.partials.auth_banner')
@stop