@extends('layouts.app')

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        @include('profiles.partials.top_area')

        @include('partials.errors')

        <vue-profile current="{{ getCurrentView($default = 'account_overview') }}">
            <template slot="account_overview"> @include('profiles.partials.overview') </template>
            <template slot="account_details"> @include('profiles.partials.details') </template>
            <template slot="address_book"> @include('profiles.partials.addresses') </template>
            <template slot="account_privacy"> @include('profiles.partials.privacy') </template>
        </vue-profile>
    </div>
@stop