@extends('layouts.app')

@section('content')
    <div class="container py-16">
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
                                        <input type="email" id="email" name="email" required class="input" placeholder="{{ trans('auth.your_email') }}">
                                    </div>
                                </div>

                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="password">{{ trans('auth.password') }} *</label>
                                        <input type="password" id="password" name="password" required class="input" placeholder="{{ trans('auth.your_password') }}">
                                    </div>
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