<template>
    <div>
        <h1 class="mb-6 text-90 font-normal text-2xl">{{ __('latest_orders') }}</h1>
        <loading-card ref="card"
            :loading="loading"
            class="card relative border border-lg border-50 overflow-hidden px-0 py-0">
            <div v-if="loading"
                style="height: 100px" />

            <div class="overflow-hidden overflow-x-auto relative">
                <table cellpadding="0"
                    cellspacing="0"
                    class="table w-full"
                    data-testid="resource-table">
                    <thead>
                        <tr>
                            <th class="text-left"><span>{{ __('order_order_number') }}</span></th>
                            <th class="text-left"><span>{{ __('placed_at') }}</span></th>
                            <th class="text-left"><span>{{ __('order_user') }}</span></th>
                            <th class="text-left"><span>{{ __('order_email') }}</span></th>
                            <th class="text-left"><span>{{ __('order_phone') }}</span></th>
                            <th class="text-left"><span>{{ __('order_status') }}</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(order, index) in orders"
                            :key="'orders-' + index">
                            <td>
                                <span class="whitespace-no-wrap text-left">{{ order.order_number }}</span>
                            </td>
                            <td>
                                <span class="whitespace-no-wrap text-left">{{ order.placed_at }}</span>
                            </td>
                            <td>
                                <span class="whitespace-no-wrap text-left"
                                    v-if="order.user">
                                    {{ order.user.name }}
                                </span>
                            </td>
                            <td>
                                <div class="whitespace-no-wrap text-left">
                                    <span>{{ order.email }}</span>
                                </div>
                            </td>
                            <td>
                                <a class="no-underline text-primary text-left"
                                    :href="`tel:+${order.phone}`">{{ order.phone }}</a>
                            </td>
                            <td>
                                <span class="whitespace-no-wrap text-left"
                                    v-if="order.status">
                                    {{ order.status.name[locale] }}
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </loading-card>
    </div>
</template>

<script>
    export default {
        props: {
            card: {
                required: true,
            },
        },

        data: () => ({
            orders: [],
            locale: null,
            loading: true,
        }),

        created() {
            this.locale = Nova.config.currentLocale;
        },

        mounted() {
            Nova.request()
                .get('/nova-vendor/latest-orders/latest')
                .then(({ data }) => {
                    this.orders = data.data;
                    this.loading = false;
                });
        },
    };
</script>
