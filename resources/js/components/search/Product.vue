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
                <span v-if="product.barcode"><strong class="mr-1">EAN</strong>{{ product.barcode }}</span>
                <span v-else-if="product.catalogue_number"><strong class="mr-1">CAT</strong>{{ product.catalogue_number }}</span>
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