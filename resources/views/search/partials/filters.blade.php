<div class="card filters mb-6 p-2">
    <div class="row items-center">
        <div class="col-half">
            <div class="icon-wrap">
                <span class="text-primary mr-4">
                    <icon-filter></icon-filter>
                </span>

                <vue-search-sort :authenticated="{{ booleanToString(auth()->check()) }}"></vue-search-sort>
                <vue-per-page :default-pagination="{{ config('config.products_default_pagination') }}"></vue-per-page>
            </div>
        </div>
        <div class="col-half">
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
    </div>
</div>