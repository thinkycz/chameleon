<div class="p-8">
    <div class="row">
        <div class="col-half">
            <h3 class="mb-2">{{ trans('profiles.addresses') }}</h3>
            <p class="mb-6">{{ trans('profiles.address_book_info') }}</p>

            <vue-addresses :new="{{ booleanToString($errors->count() && isCurrentView('address_book')) }}" inline-template>
                <transition name="fade" mode="out-in" key="addresses">
                    <div class="addresses flex flex-wrap -mx-2" v-if="!current" >
                        @foreach($user->addresses as $address)
                            @include('profiles.addresses.card')
                        @endforeach
                        <div class="address-card px-2" @click="handleAddressBoxClicked('new')">
                            <div class="address-card__inner new-address">
                                <icon-plus></icon-plus>
                            </div>
                        </div>
                    </div>
                    <div class="addresses-form" v-else key="forms">
                        @include('profiles.addresses.new')
                        @include('profiles.addresses.edit')
                    </div>
                </transition>
            </vue-addresses>

        </div>
        <div class="col-half hidden md:block">
            <div class="overflow-hidden w-2/3 mx-auto h-full">
                <img img-src="svg/address_book.svg" />
            </div>
        </div>
    </div>
</div>