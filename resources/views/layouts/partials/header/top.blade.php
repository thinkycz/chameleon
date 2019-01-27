<div id="top">
    <div class="container">
        <div class="row">

            <div class="col-half">
                @if($companyPhone = settingsRepository()->getCompanyPhoneNumber())
                    <div class="icon-wrap inline mr-4">
                        <icon-phone></icon-phone>
                        <span>{{ $companyPhone }}</span>
                    </div>
                @endif
                @if($companyEmail = settingsRepository()->getCompanyEmail())
                    <div class="icon-wrap inline">
                        <icon-mail></icon-mail>
                        <span>{{ $companyEmail }}</span>
                    </div>
                @endif
            </div>

            <div class="col-half">
                <div class="inline-block">
                    <div class="icon-wrap right-icon">
                        <vue-languages :locales="{{ json_encode(\App\Enums\Locale::all()) }}"></vue-languages>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>