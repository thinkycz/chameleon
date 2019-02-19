@extends('layouts.app')

@section('title', getPageTitle(__('footer.contact')))

@section('content')
    <div class="container pb-16">

        @include('partials.breadcrumb_area')

        <div class="row">
            <div class="col-half mx-auto">

                @include('partials.errors')

                <div class="card p-12">
                    <div class="card-heading mb-8">
                        <h3>{!! trans('contact.heading') !!}</h3>
                        <p>{{ trans('contact.subheading') }}</p>
                    </div>

                    <div class="card-body">
                        <form csrf action="{{ route('contact.contact') }}" method="post" id="contact-form">
                            <div class="row pb-4">

                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="name">{{ trans('contact.your_name') }} *</label>
                                        <input type="text" id="name" name="name" required class="input" value="{{ old('name', currentUser()->name) }}" placeholder="{{ trans('contact.your_name') }}">
                                    </div>
                                </div>

                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="email">{{ trans('auth.email') }} *</label>
                                        <input type="email" id="email" name="email" required class="input" value="{{ old('email', currentUser()->email) }}" placeholder="{{ trans('auth.your_email') }}">
                                    </div>
                                </div>

                                <div class="col-full">
                                    <div class="input-wrap">
                                        <label for="message">{{ trans('contact.your_message') }} *</label>
                                        <textarea id="message" name="message" required class="input" placeholder="{{ trans('contact.your_message_desc') }}"></textarea>
                                    </div>
                                </div>

                            </div>

                            <vue-button form-selector="#contact-form"
                                label="{{ trans('global.submit') }}"
                                button-class="btn btn-primary">
                            </vue-button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop