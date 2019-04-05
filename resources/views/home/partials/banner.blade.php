<section id="auth_banner" class="py-16 bg-grey-darkest">
    <div class="container">
        <div class="row">
            <div class="col-full">
                <h2 class="text-white mb-3 text-4xl text-center w-full">{{ $homepage['banner_heading'] }}</h2>
                <p class="text-white w-full text-lg text-center text-grey-light mb-8">{{ $homepage['banner_subheading'] }}</p>

                @if($link = $homepage['banner_action_link'])
                    <p class="text-white w-full text-center text-grey-light mb-0">
                            <a href="{{ $link }}" class="btn btn-primary btn-lg mr-6">{{ $homepage['banner_action_text'] }}</a>
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>