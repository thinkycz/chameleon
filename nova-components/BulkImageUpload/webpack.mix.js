let mix = require('laravel-mix');

mix.setPublicPath('dist')
    .js('resources/js/tool.js', 'js')
    .sass('resources/sass/tool.scss', 'css');

mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.vue', '.json'],
        alias: {
            vue$: 'vue/dist/vue.esm.js',
            '@dropzone': '../../../../DropzoneField/resources/js/components/ImageDropzone.vue',
        },
    },
});
