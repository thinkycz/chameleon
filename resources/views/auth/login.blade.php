@extends('layouts.app')

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        <div class="row">
            <div class="col-half mx-auto">

                @include('partials.errors')

                <div class="card p-12">
                    <div class="card-heading mb-8">
                        <h3>{!! trans('auth.login_heading') !!}</h3>
                        <p>{{ trans('auth.login_subheading') }}</p>
                    </div>

                    <div class="card-body">
                        <form csrf action="{{ route('login') }}" method="post">
                            <div class="row pb-4">
                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="email">{{ trans('auth.email') }} *</label>
                                        <input type="email" id="email" name="email" required class="input" value="{{ old('email') }}" placeholder="{{ trans('auth.your_email') }}">
                                    </div>
                                </div>

                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="password">{{ trans('auth.password') }} *</label>
                                        <input type="password" id="password" name="password" required class="input" placeholder="{{ trans('auth.your_password') }}">
                                    </div>
                                </div>

                                <div class="col-full">
                                    <div class="input-wrap">
                                        <div class="checkbox" style="margin-left: 0">
                                            <input type="checkbox" id="remember_me" name="remember_me">
                                            <label for="remember_me" class="checkbox-label">{{ trans('auth.remember_me') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-full">
                                    <a href="{{ route('password.request') }}" class="text-xs text-primary">{{ trans('auth.forgot_your_password') }}</a>
                                    <span class="px-2 text-xs">|</span>
                                    <a href="{{ route('register') }}" class="text-xs text-primary">{{ trans('auth.have_an_account') }}</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">{{ trans('auth.login') }}</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop