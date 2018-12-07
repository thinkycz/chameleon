Nova.booting((Vue, router) => {
    Vue.component('index-translatable-text', require('./components/IndexField'));
    Vue.component('detail-translatable-text', require('./components/DetailField'));
    Vue.component('form-translatable-text', require('./components/FormField'));
    Vue.component('dropdown-menu-translatable-text', require('./components/DropdownMenu'));
});
