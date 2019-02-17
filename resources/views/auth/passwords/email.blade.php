@extends('layouts.app')

@section('title', getPageTitle(__('auth.reset_password')))

@section('content')
    <div class="container py-16">
        <div class="row">
            <div class="col-half mx-auto">

                @include('partials.errors')

                <div class="card p-12">
                    <div class="card-heading mb-8">
                        <h3>{!! trans('auth.reset_heading') !!}</h3>
                        <p>{{ trans('auth.reset_subheading') }}</p>
                    </div>

                    <div class="card-body">
                        <form csrf action="{{ route('password.email') }}" method="post">

                            <div class="row pb-4">
                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="email">{{ trans('auth.email') }} *</label>
                                        <input type="email" id="email" name="email" required class="input" value="{{ old('email') }}" placeholder="{{ trans('auth.your_email') }}">
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ trans('auth.send_password_reset') }}</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop