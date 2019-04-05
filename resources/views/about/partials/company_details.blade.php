<div class="card p-4 items-center">
    <h3 class="text-grey-darkest pb-4 mb-4 border-b">{{ settingsRepository()->getCompanyName() }}</h3>

    <div class="row about-icons">
        <div class="col-half">
            <p style="margin-bottom: 1rem;">{{ settingsRepository()->getCompanyAbout() }}</p>
            <p class="icon-wrap"><icon-home></icon-home> <span>{{ settingsRepository()->getCompanyAddress() }}</span></p>
            <p class="icon-wrap"><icon-mail></icon-mail> <span>{{ settingsRepository()->getCompanyEmail() }}</span></p>
            <p class="icon-wrap"><icon-phone></icon-phone> <span>{{ settingsRepository()->getCompanyPhoneNumber() }}</span></p>
            <p class="icon-wrap"><icon-infocircle></icon-infocircle> <span>{{ trans('about.company_id') }}&nbsp;<strong>{{ settingsRepository()->getCompanyId() }}</strong></span></p>
            <p class="icon-wrap"><icon-cubes></icon-cubes> <span>{{ trans('about.vat_id') }}&nbsp;<strong>{{ settingsRepository()->getCompanyVatId() }}</strong></span></p>
        </div>

        <div class="col-half hidden md:block">
            <div class="overflow-hidden w-2/3 mx-auto h-full">
                <img img-src="svg/company_details.svg" />
            </div>
        </div>
    </div>
    @if($googleMap = settingsRepository()->getCompanyGoogleMap())
        <div class="mb-4 google-map">
            {!! $googleMap !!}
        </div>
    @endif
</div>