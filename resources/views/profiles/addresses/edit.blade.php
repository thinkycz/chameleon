<form csrf :action="updateAddressAction('{{ route('profiles.addresses.store', $user) }}')" method="patch" v-else>
    <div class="row pb-4">
        <div class="col-half">
            <div class="input-wrap">
                <label for="first_name">{{ trans('profiles.first_name') }}</label>
                <input type="first_name" id="first_name" required class="input" name="first_name" :value="current.first_name" placeholder="{{ trans('profiles.first_name_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="last_name">{{ trans('profiles.last_name') }}</label>
                <input type="last_name" id="last_name" required class="input" name="last_name" :value="current.last_name" placeholder="{{ trans('profiles.last_name_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="company_name">{{ trans('profiles.company_name') }}</label>
                <input type="text" id="company_name" class="input" name="company_name" :value="current.company_name" placeholder="{{ trans('profiles.company_name_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="phone">{{ trans('profiles.phone') }}</label>
                <input type="text" id="phone" required class="input" name="phone" :value="current.phone" placeholder="{{ trans('profiles.phone_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="street">{{ trans('profiles.street') }}</label>
                <input type="text" id="street" required class="input" name="street" :value="current.street" placeholder="{{ trans('profiles.street_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="city">{{ trans('profiles.city') }}</label>
                <input type="text" id="city" required class="input" name="city" :value="current.city" placeholder="{{ trans('profiles.city_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="zipcode">{{ trans('profiles.zipcode') }}</label>
                <input type="text" id="zipcode" required class="input" name="zipcode" :value="current.zipcode" placeholder="{{ trans('profiles.zipcode_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="country_id">{{ trans('profiles.country') }}</label>
                <select required name="country_id" class="input" :value="current.country_id">
                    <option value="">&mdash;</option>
                    @foreach(\App\Models\Country::whereEnabled(true)->get() as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="company_id">{{ trans('profiles.company_id') }}</label>
                <input type="text" id="company_id" class="input" name="company_id" :value="current.company_id" placeholder="{{ trans('profiles.company_id_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="vat_id">{{ trans('profiles.vat_id') }}</label>
                <input type="text" id="vat_id" class="input" name="vat_id" :value="current.vat_id" placeholder="{{ trans('profiles.vat_id_label') }}">
            </div>
        </div>

        <div class="col-full">
            <input type="hidden" name="current" value="address_book">
            <button type="submit" class="btn btn-primary">{{ trans('global.update') }}</button>
        </div>
    </div>
</form>