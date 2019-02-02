<section class="py-16">
    <div class="container">
        <div class="row">
            <div class="col-full">
                <h2 class="heading-title">{{ trans('about.some_stats') }}</h2>
                <p class="heading-subtitle">{{ trans('about.some_stats_desc') }} </p>
            </div>

            <div class="col-third">
                <div class="card p-8">
                    <span class="icon-2x text-grey-darker block text-center mb-3">
                        <icon-ribbon></icon-ribbon>
                    </span>
                    <h3 class="text-center text-grey-darkest mb-4">{{ trans('about.products') }}</h3>
                    <p class="text-center text-sm"> {!! trans('about.products_desc', ['count' => $products]) !!} </p>
                </div>
            </div>

            <div class="col-third">
                <div class="card p-8">
                    <span class="icon-2x text-grey-darker block text-center mb-3">
                        <icon-basket></icon-basket>
                    </span>
                    <h3 class="text-center text-grey-darkest mb-4">{{ trans('about.completed_orders') }}</h3>
                    <p class="text-center text-sm"> {!! trans('about.completed_orders_desc', ['count' => $orders]) !!} </p>
                </div>
            </div>

            <div class="col-third">
                <div class="card p-8">
                    <span class="icon-2x text-grey-darker block text-center mb-3">
                        <icon-gift></icon-gift>
                    </span>
                    <h3 class="text-center text-grey-darkest mb-4">{{ trans('about.happy_customers') }}</h3>
                    <p class="text-center text-sm"> {!! trans('about.happy_customers_desc', ['count' => $customers]) !!} </p>
                </div>
            </div>

        </div>
    </div>
</section>