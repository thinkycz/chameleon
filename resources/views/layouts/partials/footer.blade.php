<footer>
    <div class="container">
        <div class="row">

            <div class="col-fourth">
                <h4>{{ trans('footer.information') }}</h4>
                <ul class="list-reset">
                    <li>
                        <a href="{{ preferenceRepository()->getTermsPage()->showRoute() }}">{{ trans('footer.terms_of_use') }}</a>
                    </li>
                    <li>
                        <a href="{{ preferenceRepository()->getPrivacyPage()->showRoute() }}">{{ trans('footer.privacy_policy') }}</a>
                    </li>
                    <li>
                        <a href="{{ preferenceRepository()->getRefundsPage()->showRoute() }}">{{ trans('footer.returns_and_refunds') }}</a>
                    </li>
                    <li>
                        <a href="{{ preferenceRepository()->getFaqPage()->showRoute() }}">{{ trans('footer.faqs') }}</a>
                    </li>
                </ul>
            </div>

            <div class="col-fourth">
                <h4>{{ trans('footer.quick_links') }}</h4>
                <ul class="list-reset">
                    @auth
                        <li><a href="{{ route('about') }}">{{ trans('footer.about') }}</a></li>
                        <li><a href="{{ route('contact.index') }}">{{ trans('footer.contact') }}</a></li>
                        <li><a href="{{ route('profiles.show', currentUser(false)) }}">{{ trans('footer.my_profile') }}</a></li>

                        @if(activeBasket()->hasOrderedItems())
                            <li><a href="{{ route('basket.show') }}">{{ trans('footer.basket') }}</a></li>
                        @endif
                    @else
                        <li><a href="{{ route('login') }}">{{ trans('auth.login') }}</a></li>
                        <li><a href="{{ route('register') }}">{{ trans('auth.register') }}</a></li>
                    @endauth
                </ul>
            </div>

            <div class="col-fourth">
                <h4>{{ trans('footer.useful_links') }}</h4>
                <ul class="list-reset">
                    <li>
                        <a href="{{ route('categories.index') }}">{{ trans('footer.categories') }}</a>
                    </li>
                    @if(settingsRepository()->getCustomLink1()['title'])
                        <li>
                            <a href="{{ settingsRepository()->getCustomLink1()['link'] }}">{{ settingsRepository()->getCustomLink1()['title'] }}</a>
                        </li>
                    @endif
                    @if(settingsRepository()->getCustomLink2()['title'])
                        <li>
                            <a href="{{ settingsRepository()->getCustomLink2()['link'] }}">{{ settingsRepository()->getCustomLink2()['title'] }}</a>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="col-fourth footer-info">
                <img src="{{ settingsRepository()->getLogo() }}" alt="{{ settingsRepository()->getCompanyName() }}"/>
                <p class="p-big mt-4">{{ settingsRepository()->getCompanyName() }}</p>
                <p class="p-small icon-wrap"><icon-home></icon-home> <span>{{ settingsRepository()->getCompanyAddress() }}</span></p>
                <p class="p-small icon-wrap"><icon-mail></icon-mail> <span>{{ settingsRepository()->getCompanyEmail() }}</span></p>
                <p class="p-small icon-wrap"><icon-phone></icon-phone> <span>{{ settingsRepository()->getCompanyPhoneNumber() }}</span></p>
            </div>

        </div>
        <p class="p-small text-center pt-6 mb-2">{!! trans('footer.copyright', ['year' => date('Y')]) !!}</p>
    </div>
</footer>