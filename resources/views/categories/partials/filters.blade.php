<div class="card filters mb-6 p-2">
    <div class="row items-center">

        <div class="col w-full md:w-2/3">
            <div class="icon-wrap px-2">
                <!-- <span class="text-primary mr-4">
                    <icon-filter></icon-filter>
                </span> -->

                <vue-sort-products :authenticated="{{ booleanToString(auth()->check()) }}" :newest="true"></vue-sort-products>
                <vue-per-page :default-pagination="{{ config('config.products_default_pagination') }}"></vue-per-page>
                @if($tags->count())
                    <vue-tags-dropdown :tags="{{ json_encode($tags->values()) }}"></vue-tags-dropdown>
                @endif
                @if($category->descendants->count())
                    <vue-subcategories-dropdown :subcategories="{{ json_encode($category->descendants->toTree($category)) }}"></vue-subcategories-dropdown>
                @endif
            </div>
        </div>

        <div class="col w-full md:w-1/3">
            <div class="flex flex-wrap justify-between md:justify-end">

                <vue-filtercheckbox id="only_with_price"
                    :is-checked="{{ request()->has('only_with_price') ? request()->get('only_with_price') : 'null' }}"
                    label="{{ trans('filters.hide_without_prices') }}"
                    name="only_with_price">
                </vue-filtercheckbox>

                <vue-filtercheckbox id="in_stock_only"
                    :is-checked="{{ request()->has('in_stock_only') ? request()->get('in_stock_only') : 'null' }}"
                    label="{{ trans('filters.in_stock_only') }}"
                    name="in_stock_only">
                </vue-filtercheckbox>

            </div>
        </div>

        <div class="col-12 mx-2 border-t">

            <vue-accordion accordion="more-filters"
                :open="{{ booleanToString(request()->has('price_min') || request()->has('price_max')) }}"
                label="{{ trans('filters.more_filters') }}"
                button-class="btn-text btn-default mt-2 uppercase text-xs has-dropdown default"
            >
                @include('categories.partials.more_filters')
            </vue-accordion>

            <portal-target name="more-filters"></portal-target>
        </div>

    </div>
</div>