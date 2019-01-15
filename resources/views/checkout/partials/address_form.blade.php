<form csrf form-action="profiles.addresses.store" params="\App\Models\User::getAuthenticatedUser()" method="post">
    <div class="row pb-4">
        <div class="col-full">
            <h4 class="mb-4 text-grey-darkest">{{ trans('checkout.add_new_address') }}</h4>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="company_name">{{ trans('profiles.company_name') }}</label>
                <input type="text" id="company_name" class="input" name="company_name" value="{{ old('company_name') }}" placeholder="{{ trans('profiles.company_name_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="phone">{{ trans('profiles.phone') }}</label>
                <input type="text" id="phone" required class="input" name="phone" value="{{ old('phone') }}" placeholder="{{ trans('profiles.phone_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="company_id">{{ trans('profiles.company_id') }}</label>
                <input type="text" id="company_id" class="input" required name="company_id" value="{{ old('company_id') }}" placeholder="{{ trans('profiles.company_id_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="vat_id">{{ trans('profiles.vat_id') }}</label>
                <input type="text" id="vat_id" class="input" name="vat_id" value="{{ old('vat_id') }}" placeholder="{{ trans('profiles.vat_id_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="first_name">{{ trans('profiles.first_name') }}</label>
                <input type="first_name" id="first_name" required class="input" name="first_name" value="{{ old('first_name') }}" placeholder="{{ trans('profiles.first_name_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="last_name">{{ trans('profiles.last_name') }}</label>
                <input type="last_name" id="last_name" required class="input" name="last_name" value="{{ old('last_name') }}" placeholder="{{ trans('profiles.last_name_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="street">{{ trans('profiles.street') }}</label>
                <input type="text" id="street" required class="input" name="street" value="{{ old('street') }}" placeholder="{{ trans('profiles.street_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="city">{{ trans('profiles.city') }}</label>
                <input type="text" id="city" required class="input" name="city" value="{{ old('city') }}" placeholder="{{ trans('profiles.city_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="zipcode">{{ trans('profiles.zipcode') }}</label>
                <input type="text" id="zipcode" required class="input" name="zipcode" value="{{ old('zipcode') }}" placeholder="{{ trans('profiles.zipcode_label') }}">
            </div>
        </div>

        <div class="col-half">
            <div class="input-wrap">
                <label for="country_id">{{ trans('profiles.country') }}</label>
                <select required name="country_id" class="input">
                    <option value="">&mdash;</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->id }}" {{ selectedIf(old('country_id') == $country->id) }}>{{ $country->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-full">
            <button type="submit" class="btn btn-primary mr-4">{{ trans('global.save') }}</button>
            <button type="button" class="btn-text btn-primary close">{{ trans('global.close') }}</button>
        </div>
    </div>
</form>
