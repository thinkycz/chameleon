<div class="col-cart">
    @auth
        <vue-header-basket :basket="{{ json_encode(activeBasket()) }}"
            :is-disabled="{{ booleanToString(request()->routeIs('basket.*', 'checkout.*', 'confirmation.*')) }}">
        </vue-header-basket>

        <vue-dropdown inline-template>
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
                            @can('viewNova', auth()->user())
                                <li>
                                    <a href="{{ route('admin') }}">{{ trans('header.admin') }}</a>
                                </li>
                            @endcan
                            <li>
                                <a href="{{ route('profiles.show') }}">{{ trans('header.my_profile') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('profiles.show', ['current' => 'account_details']) }}">{{ trans('header.my_details') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('profiles.show', ['current' => 'address_book']) }}">{{ trans('header.my_address_book') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('profiles.show', ['current' => 'account_privacy']) }}">{{ trans('header.my_privacy') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('logout') }}">{{ trans('header.logout') }}</a>
                            </li>
                        </ul>
                    </div>
                </transition>
            </div>
        </vue-dropdown>
    @else
        <div class="text-center w-full">
            <a href="{{ route('login') }}" class="btn btn-primary btn-sm mr-2">{{ trans('header.login') }}</a>
            <a href="{{ route('register') }}" class="btn btn-primary btn-sm">{{ trans('header.register') }}</a>
        </div>
    @endauth
</div>