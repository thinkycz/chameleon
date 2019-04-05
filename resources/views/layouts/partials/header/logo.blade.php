<div class="col-logo">
    <div class="icon-wrap justify-between">

        <a href="{{ route('home') }}">
            <img src="{{ settingsRepository()->getLogo() }}" alt="{{ config('app.name') }}"/>
        </a>

        <vue-dropdown inline-template>
            <div class="dropdown dropdown-categories" @click.stop="toggle">
                <span class="menu-toggler cursor-pointer">
                    <icon-menu></icon-menu>
                </span>

                <transition name="fade">
                    <div class="dropdown-menu" v-if="visible" v-click-outside="close" @click.stop="blank">
                        <icon-dropdown></icon-dropdown>
                        <ul class="list-reset">
                            <li class="flex justify-between items-center">
                                <a href="{{ route('categories.index') }}">{{ __('home.all_categories') }}</a>
                            </li>
                            @foreach($categories as $category)
                                <li class="flex justify-between items-center">
                                    <a href="{{ route('categories.show', $category) }}">{{ $category->name }}</a>
                                    <span class="badge accent badge-sm h-6 mr-2 leading-none">{{ $category->products_count }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </transition>
            </div>
        </vue-dropdown>

    </div>
</div>