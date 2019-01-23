<header>
    <div id="top">
        <div class="container">
            <div class="row">
                <div class="col-half">
                    <div class="icon-wrap inline mr-4">
                        <icon-phone></icon-phone>
                        <span>+321/313321-422</span>
                    </div>
                    <div class="icon-wrap inline">
                        <icon-mail></icon-mail>
                        <span>example@email.com</span>
                    </div>
                </div>
                <div class="col-half">
                    <div class="inline-block mr-4">
                        <div class="icon-wrap right-icon">
                            <span>Language</span>
                            <icon-carretdown></icon-carretdown>
                        </div>
                    </div>
                    <div class="inline-block">
                        <div class="icon-wrap right-icon">
                            <span>Currency</span>
                            <icon-carretdown></icon-carretdown>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header">
        <div class="container">
            <div class="row">
                <div class="col-logo">
                    <div class="icon-wrap justify-between">
                        <img src="http://enormous.test/img/skytrade.png" />
                        <span class="menu-toggler">
                            <icon-menu></icon-menu>
                        </span>
                    </div>
                </div>

                <vue-search query="{{ request('query') }}" route="{{ route('search') }}"
                    eligible-to-see-prices="{{ booleanToString(auth()->check()) }}">
                </vue-search>

                <div class="col-cart">
                    @auth
                        <vue-header-basket :basket="{{ json_encode(activeBasket()) }}"
                            :is-disabled="{{ booleanToString(request()->routeIs('basket.*', 'checkout.*', 'confirmation.*')) }}">
                        </vue-header-basket>

                        <vue-dropdown-menu inline-template>
                            <div class="user-dropdown relative" @click.stop="toggle">
                                <div class="user-icon">
                                    <img src="{{ currentUser()->thumb }}" alt="{{ currentUser()->name }}">
                                </div>
                                <div class="user-info">
                                    <p class="p-big">{{ currentUser()->email }}</p>
                                    <p class="p-small">{{ trans('header.welcome', ['name' => currentUser()->last_name]) }}</p>
                                </div>

                                <transition name="fade">
                                    <div class="user-dropdown-menu" v-if="visible" v-click-outside="close" @click.stop="blank">
                                        <icon-dropdown></icon-dropdown>
                                        <ul class="list-reset">
                                            <li>
                                                <a href="{{ route('profiles.show', currentUser()->id) }}"">{{ trans('header.my_profile') }}</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('logout') }}">{{ trans('header.logout') }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </transition>
                            </div>
                        </vue-dropdown-menu>
                    @else
                        <div class="text-center w-full">
                            <a href="{{ route('login') }}" class="btn btn-primary btn-sm mr-2">{{ trans('header.login') }}</a>
                            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">{{ trans('header.register') }}</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>