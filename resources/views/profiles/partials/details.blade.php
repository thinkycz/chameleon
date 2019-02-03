<div class="p-8">
    <form csrf method="patch" form-action="profiles.update" files>
        <div class="row">
            <div class="col-half">
                <h3 class="mb-2">{{ trans('profiles.your_personal_information') }}</h3>
                <p class="mb-6">{{ trans('profiles.update_personal_info') }}</p>
                <div class="row pb-4">
                    <div class="col-half">
                        <div class="input-wrap">
                            <label for="first_name">{{ trans('profiles.first_name') }}</label>
                            <input type="text" id="first_name" required class="input" name="first_name" value="{{ old('first_name', $user->first_name) }}" placeholder="{{ trans('profiles.first_name_label') }}">
                        </div>
                    </div>

                    <div class="col-half">
                        <div class="input-wrap">
                            <label for="last_name">{{ trans('profiles.last_name') }}</label>
                            <input type="text" id="last_name" required class="input" name="last_name" value="{{ old('last_name', $user->last_name) }}" placeholder="{{ trans('profiles.last_name_label') }}">
                        </div>
                    </div>

                    <div class="col-half">
                        <div class="input-wrap">
                            <label for="email">{{ trans('profiles.email') }}</label>
                            <input type="email" id="email" required class="input" name="email" value="{{ old('email', $user->email) }}" placeholder="{{ trans('profiles.email_label') }}">
                        </div>
                    </div>

                    <div class="col-half">
                        <div class="input-wrap">
                            <label for="phone">{{ trans('profiles.phone') }}</label>
                            <input type="text" id="phone" required class="input" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="{{ trans('profiles.phone_label') }}">
                        </div>
                    </div>

                    <div class="col-half">
                        <div class="input-wrap">
                            <label for="password">{{ trans('profiles.password') }}</label>
                            <input type="password" id="password" class="input" name="password" placeholder="{{ trans('profiles.password_label') }}">
                        </div>
                    </div>

                    <div class="col-half">
                        <div class="input-wrap">
                            <label for="password_confirmation">{{ trans('profiles.password_confirmation') }}</label>
                            <input type="password" id="password_confirmation" class="input" name="password_confirmation" placeholder="{{ trans('profiles.password_confirmation_label') }}">
                        </div>
                    </div>

                    <div class="col-full">
                        <vue-fileinput></vue-fileinput>
                    </div>
                </div>

                <input type="hidden" name="current" value="account_details">
                <button type="submit" class="btn btn-primary">{{ trans('global.update') }}</button>
            </div>
            <div class="col-half sm:hidden md:block">
                <div class="overflow-hidden w-2/3 mx-auto h-full">
                    <img img-src="svg/profile.svg" />
                </div>
            </div>
        </div>
    </form>
</div>