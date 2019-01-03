@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            <div class="col-half mx-auto">

                @include('partials.errors')

                <div class="card p-12">
                    <div class="card-heading mb-8">
                        <h3>{!! trans('auth.reset_password_heading') !!}</h3>
                        <p>{{ trans('auth.reset_password_subheading') }}</p>
                    </div>

                    <div class="card-body">
                        <form csrf action="{{ route('password.update') }}" method="post">

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row pb-4">
                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="email">{{ trans('auth.email') }} *</label>
                                        <input type="email" id="email" name="email" required class="input" value="{{ $email ?? old('email') }}" placeholder="{{ trans('auth.your_email') }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row pb-4">
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

                            <button type="submit" class="btn btn-primary">{{ trans('auth.reset_password') }}</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop