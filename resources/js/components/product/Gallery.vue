<template>
    <div class="flex flex-wrap product-gallery">
        <div></div>
        <div class="thumbs py-2 px-2"
            v-if="images.length > 1">
            <div class="product-thumb"
                v-for="image in images"
                :key="'image-' + image.id"
                :class="{'active': current == image.id}">
                <img :src="thumb(image)"
                    :alt="image.name"
                    class="" />
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props: {
            images: {
                required: true,
            },
        },

        data() {
            return {
                current: this.images.length > 0 ? this.images[0].id : null,
            };
        },

        methods: {
            optimized(image) {
                return `${window.baseURL}${image.optimized}`;
            },

            thumb(image) {
                return `${window.baseURL}${image.thumb}`;
            },
        },
    };
</script>