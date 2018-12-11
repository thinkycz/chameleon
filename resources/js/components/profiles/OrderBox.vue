<template>
    <div class="order-card px-2"
        @click.prevent="orderBoxClicked(order)">
        <div class="order-card__inner">
            <p class="font-bold mb-2">{{ order.order_number }}</p>
            <p class="icon-wrap text-sm mb-2">
                <icon-circlecheck></icon-circlecheck>
                <span>{{ $trans('profiles.total_ordered') }} <strong class="text-primary">{{ order.formatted_total_price }}</strong></span>
            </p>
            <p class="icon-wrap text-xs mb-2 text-grey-500">
                <icon-calendar></icon-calendar>
                <span>{{ $trans('profiles.ordered_at') }} {{ order.formatted_created_at }}</span>
            </p>
            <p class="text-sm mb-0">
                <span class="badge accent text-xs">{{ order.status.name[locale] }}</span>
            </p>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            order: {
                required: true,
            },
            orderBoxClicked: {
                required: true,
            },
        },
        data() {
            return {
                locale: window.currentLocale,
            };
        },
    };
</script>