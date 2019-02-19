@extends('layouts.app')

@section('title', getPageTitle(__('auth.register')))

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        <div class="row">
            <div class="col-half mx-auto">

                @include('partials.errors')

                <div class="card p-12">

                    <div class="card-heading mb-8">
                        <h3>{!! trans('auth.register_heading') !!}</h3>
                        <p>{{ trans('auth.register_subheading') }}</p>
                    </div>

                    <div class="card-body">
                        <form csrf form-action="register" method="post" id="register-form">
                            <div class="row pb-4">

                                <div class="col-half">
                                    <div class="input-wrap">
                                        <label for="first_name">{{ trans('auth.first_name') }} *</label>
                                        <input type="text" name="first_name" id="first_name" required class="input" value="{{ old('first_name') }}" placeholder="{{ trans('auth.your_first_name') }}">
                                    </div>
                                </div>

                                <div class="col-half">
                                    <div class="input-wrap">
                                        <label for="last_name">{{ trans('auth.last_name') }} *</label>
                                        <input type="text" name="last_name" id="last_name" required class="input" value="{{ old('last_name') }}" placeholder="{{ trans('auth.your_last_name') }}">
                                    </div>
                                </div>

                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="email">{{ trans('auth.email') }} *</label>
                                        <input type="email" name="email" id="email" required class="input" value="{{ old('email') }}" placeholder="{{ trans('auth.your_email') }}">
                                    </div>
                                </div>

                                <div class="col-half">
                                    <div class="input-wrap">
                                        <label for="password">{{ trans('auth.password') }} *</label>
                                        <input type="password" name="password" id="password" required class="input" placeholder="{{ trans('auth.your_password') }}">
                                    </div>
                                </div>

                                <div class="col-half">
                                    <div class="input-wrap">
                                        <label for="password_confirmation">{{ trans('auth.confirmation') }} *</label>
                                        <input type="password" name="password_confirmation" id="password_confirmation" required class="input" placeholder="{{ trans('auth.confirm_password') }}">
                                    </div>
                                </div>

                            </div>

                            <vue-button form-selector="#register-form"
                                label="{{ trans('auth.register') }}"
                                button-class="btn btn-primary">
                            </vue-button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
