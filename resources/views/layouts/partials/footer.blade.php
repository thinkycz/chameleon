<footer>
    <div class="container">
        <div class="row">
            <div class="col-fourth footer-info">
                <img src="{{ settingsRepository()->getLogo() }}" alt="{{ config('app.name') }}"/>
            </div>
            <div class="col-fourth">
                <h4>Our Company</h4>
                <ul class="list-reset">
                    <li>
                        <a href="{{ preferenceRepository()->getTermsPage()->showRoute() }}">Terms and Conditions</a>
                    </li>
                    <li>
                        <a href="{{ preferenceRepository()->getPrivacyPage()->showRoute() }}">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="{{ preferenceRepository()->getRefundsPage()->showRoute() }}">Refunds and returns</a>
                    </li>
                    <li>
                        <a href="{{ preferenceRepository()->getFaqPage()->showRoute() }}">Frequently asked questions</a>
                    </li>
                </ul>
            </div>
            <div class="col-fourth">
                <h4>Links</h4>
                <ul class="list-reset">
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
                    <li>
                        <a href="{{ auth()->check() ? route('profiles.show', auth()->user()) : route('login') }}">My Account</a>
                    </li>
                    <li>
                        <a href="#">Contact Us</a>
                    </li>
                </ul>
            </div>
            <div class="col-fourth">
                <h4>
                    Subscribe
                </h4>
            </div>
        </div>
    </div>
</footer>