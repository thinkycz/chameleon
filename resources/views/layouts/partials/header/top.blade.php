<div id="top">
    <div class="container">
        <div class="row">

            <div class="col-half">
                @php
                    $companyDetails = settingsRepository()->configuration('company_details');
                @endphp

                @if($companyDetails['phone'])
                    <div class="icon-wrap inline mr-4">
                        <icon-phone></icon-phone>
                        <span>{{ $companyDetails['phone'] }}</span>
                    </div>
                @endif
                @if($companyDetails['email'])
                    <div class="icon-wrap inline">
                        <icon-mail></icon-mail>
                        <span>{{ $companyDetails['email'] }}</span>
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