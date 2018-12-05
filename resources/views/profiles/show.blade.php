@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            <div class="col-full">
                <div class="user-bar card">
                    <div class="user-image">
                        <div class="user-image__img">
                            <img src="{{ $user->thumb }}" alt="{{ $user->name }}">
                        </div>
                        <div class="user-image__data">
                            <p class="font-bold">{{ $user->email }}</p>
                            <p class="text-sm text-grey-darker">{{ trans('profiles.member_since', ['date' => $user->formatted_created_at]) }}</p>
                        </div>
                    </div>
                    <div class="user-counters">

                    </div>
                    <div class="user-graph"></div>
                </div>
            </div>
        </div>

        <vue-profile current="{{ request()->get('current', 'account_overview') }}">
            <template slot="account_overview"> @include('profiles.partials.overview') </template>
            <template slot="account_details"> @include('profiles.partials.details') </template>
            <template slot="address_book"> @include('profiles.partials.addresses') </template>
            <template slot="account_privacy"> @include('profiles.partials.privacy') </template>
            <template slot="change_password"> @include('profiles.partials.password') </template>
        </vue-profile>
    </div>
@stop