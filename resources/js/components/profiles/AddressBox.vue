<template>
    <div class="address-card px-2"
        @click.prevent="addressBoxClicked(address)">
        <div class="address-card__inner">

            <button class="btn-text btn-danger btn-delete"
                @click.stop.prevent="addressBoxDestroyed(route)">
                <icon-trash></icon-trash>
            </button>

            <p class="font-bold text-lg mb-0"
                v-if="address.company_name">{{ address.company_name }}</p>
            <p class="mb-2">{{ `${address.first_name} ${address.last_name}` }}</p>
            <p class="text-sm mb-2">
                <span class="icon-wrap">
                    <icon-navigate></icon-navigate>
                    <span>{{ `${address.street}, ${address.zipcode} ${address.city}` }}</span>
                </span>
            </p>

            <p v-if="!address.is_default">
                <button class="btn-text btn-primary"
                    @click.stop.prevent="addressBoxMakeDefault(route)">
                    {{ $trans('profiles.make_default') }}
                </button>
            </p>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            address: {
                required: true,
            },

            route: {
                required: true,
            },

            addressBoxClicked: {
                required: true,
            },

            addressBoxDestroyed: {
                required: true,
            },

            addressBoxMakeDefault: {
                required: true,
            },
        },
    };
</script>