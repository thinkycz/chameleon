<template>
    <li :style="additionalStyle"
        class="list-item col-half">
        <div class="image">
            <img class="rounded-lg-img"
                :src="product.thumb"
                :alt="product.slug">
        </div>
        <div class="data">
            <h4>
                <a class="truncate"
                    :href="product.show_path">{{ product.name }}</a>
            </h4>
            <p class="text-xs text-grey-darker mb-0">
                <span v-if="product.catalogue_number">{{ $trans('products.catalogue_number') }}<strong class="ml-1">{{ product.catalogue_number }}</strong></span>
                <span v-if="product.barcode">{{ $trans('products.barcode') }}<strong class="ml-1">{{ product.barcode }}</strong></span>
            </p>
            <p class="mb-0"
                v-if="product.formatted_price">
                <span class="price mr-1 inline-block">{{ product.formatted_price }}</span>
            </p>
        </div>
    </li>
</template>

<script>
    export default {
        props: {
            product: {
                required: true,
            },

            additionalStyle: {
                required: true,
                default: null,
            },
        },
    };
</script>