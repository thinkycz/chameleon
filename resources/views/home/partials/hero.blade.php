<section id="hero" class="py-16 bg-white">
    <div class="container">
        <div class="row items-center">
            <div class="col-half">
                <h2 class="text-5xl tracking-tight text-primary mb-6">
                    {{ $homepage['heading'] ?: trans('home.welcome') }}
                </h2>
                <p class="text-lg mb-8">
                    {{ $homepage['subheading'] ?: trans('home.subheading') }}
                </p>
                <p>
                    <a href="{{ route('categories.index') }}" class="btn btn-primary btn-lg">{{ trans('home.explore_now') }}</a>
                </p>
            </div>
            <div class="col-half">
                <div class="overflow-hidden w-full h-full pt-8 hidden md:block">
                    @if($image = $homepage['image'])
                        <img img-src="{{ $image }}" />
                    @else
                        <img img-src="svg/home.svg" />
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>