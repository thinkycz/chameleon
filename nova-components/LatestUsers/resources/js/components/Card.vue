<template>
    <div>
        <h1 class="mb-6 text-90 font-normal text-2xl">{{ __('latest_users') }}</h1>
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
                            <th class="text-left"><span>{{ __('user_id') }}</span></th>
                            <th class="text-left"><span>&nbsp;</span></th>
                            <th class="text-left"><span>{{ __('user_name') }}</span></th>
                            <th class="text-left"><span>{{ __('order_email') }}</span></th>
                            <th class="text-left"><span>{{ __('order_phone') }}</span></th>
                            <th class="text-left"><span>{{ __('user_price_level') }}</span></th>
                            <th class="text-left"><span>{{ __('user_is_active') }}</span></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(user, index) in users"
                            :key="'users-' + index">
                            <td>
                                <span class="whitespace-no-wrap text-left">{{ user.id }}</span>
                            </td>
                            <td>
                                <p class="text-center">
                                    <img :src="user.image"
                                        class="rounded-full w-8 h-8"
                                        style="object-fit: cover;">
                                </p>
                            </td>
                            <td>
                                <span class="whitespace-no-wrap text-left">{{ user.name }}</span>
                            </td>
                            <td>
                                <div class="whitespace-no-wrap text-left">
                                    <span>{{ user.email }}</span>
                                </div>
                            </td>
                            <td>
                                <a class="no-underline text-primary text-left"
                                    :href="`tel:+${user.phone}`">{{ user.phone }}</a>
                            </td>
                            <td>
                                <span class="whitespace-no-wrap text-left"
                                    v-if="user.price_level">
                                    {{ user.price_level.name }}
                                </span>
                            </td>
                            <td>
                                <div class="text-center">
                                    <span class="inline-block rounded-full w-2 h-2"
                                        :class="{'bg-success': user.is_active, 'bg-danger': !user.is_active}" />
                                </div>
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
            users: [],
            loading: true,
        }),

        mounted() {
            Nova.request()
                .get('/nova-vendor/latest-users/latest')
                .then(({ data }) => {
                    this.users = data.data;
                    this.loading = false;
                });
        },
    };
</script>
