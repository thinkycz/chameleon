<vue-checkout-address-form action="{{ route('checkout.addresses.store') }}" inline-template>
    <div class="row">
        <div class="col-full">
            <h4 class="mb-4 text-grey-darkest">{{ trans('checkout.add_new_address') }}</h4>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="company_name">{{ trans('profiles.company_name') }}</label>
                <input type="text" id="company_name" :class="{'invalid': $v.company_name.$error}" class="input" name="company_name" v-model="company_name" placeholder="{{ trans('profiles.company_name_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="phone">{{ trans('profiles.phone') }}</label>
                <input type="text" id="phone" :class="{'invalid': $v.phone.$error}" class="input" name="phone" v-model="phone" placeholder="{{ trans('profiles.phone_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap has-addon">
                <label for="company_id">{{ trans('profiles.company_id') }}</label>
                <div class="relative">
                    <input type="text" id="company_id" class="input" :class="{'invalid': $v.company_id.$error}" name="company_id" v-model="company_id" placeholder="{{ trans('profiles.company_id_label') }}">
                    <ares-fetcher @change="handleAresOnFetch($event)"
                    :company_id="company_id"></ares-fetcher>
                </div>
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="vat_id">{{ trans('profiles.vat_id') }}</label>
                <input type="text" id="vat_id" class="input" name="vat_id" v-model="vat_id" placeholder="{{ trans('profiles.vat_id_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="first_name">{{ trans('profiles.first_name') }}</label>
                <input type="text" id="first_name" :class="{'invalid': $v.first_name.$error}" class="input" name="first_name" v-model="first_name" placeholder="{{ trans('profiles.first_name_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="last_name">{{ trans('profiles.last_name') }}</label>
                <input type="text" id="last_name" :class="{'invalid': $v.last_name.$error}" class="input" name="last_name" v-model="last_name" placeholder="{{ trans('profiles.last_name_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="street">{{ trans('profiles.street') }}</label>
                <input type="text" id="street" :class="{'invalid': $v.street.$error}" class="input" name="street" v-model="street" placeholder="{{ trans('profiles.street_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="city">{{ trans('profiles.city') }}</label>
                <input type="text" id="city" :class="{'invalid': $v.city.$error}" class="input" name="city" v-model="city" placeholder="{{ trans('profiles.city_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="zipcode">{{ trans('profiles.zipcode') }}</label>
                <input type="text" id="zipcode" :class="{'invalid': $v.zipcode.$error}" class="input" name="zipcode" v-model="zipcode" placeholder="{{ trans('profiles.zipcode_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="country_id">{{ trans('profiles.country') }}</label>
                <select :class="{'invalid': $v.country_id.$error}" name="country_id" class="input" v-model="country_id">
                    <option value="">&mdash;</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ selectedIf(old('country_id') == $country->id) }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-full mt-4">
            <button type="submit" class="btn btn-primary mr-4" @click="submit">{{ trans('global.save') }}</button>
            <button type="button" class="btn-text btn-primary close">{{ trans('global.close') }}</button>
        </div>
    </div>
</vue-checkout-address-form>
