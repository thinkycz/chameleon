<section id="auth_banner" class="py-16 bg-grey-darkest">
    <div class="container">
        <div class="row">
            <div class="col-full">
                <h2 class="text-white mb-3 text-4xl text-center w-full">{{ trans('home.what_waiting') }}</h2>
                <p class="text-white w-full text-lg text-center text-grey-light mb-8">{{ trans('home.register_with_us') }}</p>

                <p class="text-white w-full text-center text-grey-light mb-0">
                    <a href="{{ route('login') }}" class="btn btn-primary btn-lg mr-6">{{ trans('header.login') }}</a>
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">{{ trans('header.register') }}</a>
                </p>
            </div>
        </div>
    </div>
</section>