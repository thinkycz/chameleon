<div class="p-8">
    <div class="row">
        <div class="col-half">
            <div>
                <h3 class="mb-2">{{ trans('profiles.privacy_policy') }}</h3>
                <p class="mb-6">{{ trans('profiles.privacy_policy_info') }}</p>
            </div>
            <hr class="border-t">
            <div class="mb-4">
                <h3 class="mb-2 mt-6">{{ trans('profiles.export_data') }}</h3>
                <p class="mb-4">{{ trans('profiles.request_export') }}</p>

                <vue-button method="post"
                    action="{{ route('profiles.download_account_data', $user) }}"
                    :confirm="true"
                    button-class="btn btn-danger"
                    label="{{ trans('profiles.request_download') }}">
                </vue-button>

            </div>
        </div>
        <div class="col-half sm:hidden md:block">
            <div class="overflow-hidden w-2/3 mx-auto h-full pt-16">
                <img img-src="svg/privacy_policy.svg" />
            </div>
        </div>

        <div class="col-full">
            <hr class="border-t">
            <div>
                <h3 class="mb-2 mt-6">{{ trans('profiles.permanently_delete_your_account') }}</h3>
                <p>{{ trans('profiles.honor_your_right_to_be_forgotten') }}</p>

                <ul class="circled-list">
                    <li>{{ trans('profiles.delete_your_account') }}</li>
                    <li>{{ trans('profiles.request_3rd_party_services') }}</li>
                    <li>{{ trans('profiles.contact_you_and_let_you_know') }}</li>
                </ul>

                <p>{{ trans('profiles.we_cannot_remove_some_info')}}</p>

                <ul class="circled-list">
                    <li>{{ trans('profiles.billing_information')}}</li>
                    <li>{{ trans('profiles.company_information') }}</li>
                    <li>{{ trans('profiles.products_sold_info') }}</li>
                </ul>

                <p>{{ trans('profiles.let_us_know') }} </p>
                @php
                    $emailAddress = config('mail.from.address');
                @endphp
                <p class="font-bold">{{ trans('profiles.request_a_complete_deletion') }} <a href="mailto:{{ $emailAddress }}">{{ $emailAddress }}</a></p>
                <p>{{ trans('profiles.process_within_30_days') }}</p>
            </div>
        </div>
    </div>
</div>