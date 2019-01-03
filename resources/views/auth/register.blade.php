@extends('layouts.app')

@section('content')
    <div class="container py-16">
        <div class="row">
            <div class="col-half mx-auto">

                @include('partials.errors')

                <div class="card p-12">

                    <div class="card-heading mb-8">
                        <h3><span>Do you</span> want to join us?</h3>
                        <p>Register on our website to get your own and personalized shopping experience online. Register by filling the details below. Its simple and easy!</p>
                    </div>

                    <div class="card-body">
                        <form action="">
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
                                        <label for="password">Password *</label>
                                        <input type="password" id="password" required class="input" placeholder="Your password">
                                    </div>
                                </div>

                                <div class="col-half">
                                    <div class="input-wrap">
                                        <label for="password_confirmation">Confirmation *</label>
                                        <input type="text" id="password_confirmation" required class="input" placeholder="Confirm your password">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop
