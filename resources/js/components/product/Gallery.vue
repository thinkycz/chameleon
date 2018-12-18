<template>
    <div class="product-gallery">
        <div class="preview">
            <slick ref="slick"
                :options="slickOptions"
                class="slick">
                <a v-for="image in images"
                    :href="image.url"
                    data-lightbox="product-gallery"
                    :data-title="image.name"
                    :key="'image' + image.id">
                    <img :src="image.optimized"
                        :alt="image.name">
                </a>
            </slick>
        </div>
        <div class="thumbs"
            v-if="images.length > 1">
            <div class="prev-thumb">
                <div class="thumb-slider">
                    <a v-for="(image, index) in images"
                        href="#!"
                        @click.prevent="select(index)"
                        :key="'thumb-' + image.id"><img :src="image.thumb"
                            :alt="image.name"></a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Slick from 'vue-slick';
    import 'slick-carousel/slick/slick.css';

    export default {
        props: {
            images: {
                required: true,
            },
        },

        data() {
            return {
                slickOptions: {
                    slidesToShow: 1,
                    arrows: false,
                    infinite: false,
                },
            };
        },

        methods: {
            next() {
                this.$refs.slick.next();
            },

            prev() {
                this.$refs.slick.prev();
            },

            select(index) {
                this.$refs.slick.goTo(index);
            },

            reInit() {
                this.$nextTick(() => {
                    this.$refs.slick.reSlick();
                });
            },
        },

        components: {
            Slick,
        },
    };
</script>
