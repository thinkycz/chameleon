<div class="row pb-4">
    <div class="col-full">
        <div class="flex flex-wrap justify-between mb-2 pb-2 border-b">
            <h4>@{{ current.order_number }} - @{{ current.formatted_created_at }}</h4>
            <span class="badge accent text-sm">@{{ current.status.name[locale] }}</span>
        </div>
    </div>
    <div class="col-half">
        <p class="text-grey-900 mb-1">{{ trans('profiles.billing_details') }}</p>
        <address class="roman text-sm mb-6">
            <template v-if="current.billing_detail.company_name">
                <strong>@{{ current.billing_detail.company_name }}</strong>
                <br>
            </template>
            <strong>@{{ current.billing_detail.first_name }} @{{ current.billing_detail.last_name }}</strong><br>
            @{{ current.billing_detail.street }}<br>
            @{{ current.billing_detail.zipcode }} @{{ current.billing_detail.city }}
            <br>
            <strong class="mr5">{{ trans('profiles.phone') }}: </strong>@{{ current.billing_detail.phone }}
        </address>
    </div>
    <div class="col-half">
        <p class="text-grey-900 mb-1">{{ trans('profiles.shipping_details') }}</p>
        <address class="roman text-sm mb-6">
            <template v-if="current.shipping_detail.company_name">
                <strong>@{{ current.shipping_detail.company_name }}</strong>
                <br>
            </template>
            <strong>@{{ current.shipping_detail.first_name }} @{{ current.shipping_detail.last_name }}</strong><br>
            @{{ current.shipping_detail.street }}<br>
            @{{ current.shipping_detail.zipcode }} @{{ current.shipping_detail.city }}
            <br>
            <strong class="mr5">{{ trans('profiles.phone') }}: </strong>@{{ current.shipping_detail.phone }}
        </address>
    </div>
    <div class="col-full">
        <div class="flex flex-wrap justify-between border-b pb-2 mb-2 text-sm">
            <strong>{{ trans('profiles.company_id') }}: @{{ current.billing_detail.company_id }}</strong>
            <strong>{{ trans('profiles.vat_id') }}: @{{ current.billing_detail.vat_id }}</strong>
        </div>
    </div>
    <div class="col-full">
        <div class="flex flex-wrap justify-between border-b pb-2 mb-2 text-sm">
            <strong>{{ trans('profiles.payment_method') }}: @{{ current.payment_method.name[locale] }}</strong>
            <strong>{{ trans('profiles.delivery_method') }}: @{{ current.delivery_method.name[locale] }}</strong>
        </div>
    </div>
    <div class="col-full mt-4">
        <h4 class="border-b mb-2 pb-2">{{ trans('profiles.ordered_items') }}</h4>
        <!-- put ordered items here -->
    </div>
    <div class="col-full mt-4">
        <a href="#!" @click.prevent="handleClickOnBack" class="text-grey-darker font-bold">{{ trans('global.back') }}</a>
    </div>
</div>