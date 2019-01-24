<div class="p-8">
    <div class="row">
        <div class="col-half">
            <h3 class="mb-2">{{ trans('profiles.overview') }}</h3>
            <p class="mb-6">{{ trans('profiles.overview_info') }}</p>

            <vue-orders order="{{ Session::get('placed_order') }}" inline-template>
                <transition name="fade" mode="out-in" key="orders">
                    <div class="orders flex flex-wrap -mx-2" v-if="!current" >
                        @foreach($user->orders as $order)
                            @include('profiles.orders.card')
                        @endforeach
                    </div>
                    <div class="orders-form" v-else key="show">
                        @include('profiles.orders.show')
                    </div>
                </transition>
            </vue-orders>

        </div>
        <div class="col-half sm:hidden md:block">
            <div class="overflow-hidden w-2/3 mx-auto h-full">
                <img img-src="svg/overview.svg" />
            </div>
        </div>
    </div>
</div>