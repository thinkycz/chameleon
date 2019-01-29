<div class="row">
    <div class="col-full">
        <div class="user-bar card">
            <div class="user-image">
                <div class="rounded-img">
                    <img src="{{ $user->thumb }}" alt="{{ $user->name }}">
                </div>
                <div class="user-image__data">
                    <p class="font-bold">{{ $user->email }}</p>
                    <p class="text-sm text-grey-darker">{{ trans('profiles.member_since', ['date' => $user->formatted_created_at]) }}</p>
                </div>
            </div>
            <div class="user-counters">
                <p class="mb-3 font-bold text-sm">
                    <span class="justify-center icon-wrap">
                        <icon-star></icon-star>
                        <span>{!! trans('profiles.your_price_level', ['level' => optional($user->priceLevel)->name]) !!}</span>
                    </span>
                </p>
                <p class="mb-0 font-bold text-sm">
                    <span class="justify-center icon-wrap">
                        <icon-ribbon></icon-ribbon>
                        <span>{!! trans('profiles.your_total_orders', ['total' => $user->orders()->count()]) !!}</span>
                    </span>
                </p>
            </div>
            <div class="user-graph">
                <div class="px-2">
                    <p class="mb-1 text-center font-bold text-sm">{{ trans('profiles.your_past_orders') }}</p>
                    <vue-profile-chart :currency="{{ currentCurrency() }}"
                        :labels="{{ json_encode($orderStats->pluck('point')) }}"
                        :series="{{ json_encode($orderStats->pluck('value')) }}"
                    ></vue-profile-chart>
                </div>
            </div>
        </div>
    </div>
</div>