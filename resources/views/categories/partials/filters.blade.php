<div class="card filters mb-6 py-2 px-4">
    <div class="flex items-center justify-between">
        <div class="icon-wrap px-2">
            <vue-sort-products :authenticated="{{ booleanToString(auth()->check()) }}" :newest="true"></vue-sort-products>
            <vue-per-page :default-pagination="{{ config('config.products_default_pagination') }}"></vue-per-page>
            @if($tags->count())
                <vue-tags-dropdown :tags="{{ json_encode($tags->values()) }}"></vue-tags-dropdown>
            @endif
            @if($category->descendants->count())
                <vue-subcategories-dropdown :subcategories="{{ json_encode($category->descendants->toTree($category)) }}"></vue-subcategories-dropdown>
            @endif
        </div>

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

            <vue-accordion accordion="more-filters"
                    :open="{{ booleanToString(request()->has('price_min') || request()->has('price_max')) }}"
                    label="{{ trans('filters.more_filters') }}"
                    button-class="btn-text btn-default uppercase text-xs has-dropdown default">
                @include('categories.partials.more_filters')
            </vue-accordion>
        </div>
    </div>

    <portal-target name="more-filters"></portal-target>
</div>