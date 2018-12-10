Nova.booting((Vue, router) => {
    Vue.component('index-translatable-textarea', require('./components/IndexField'));
    Vue.component('detail-translatable-textarea', require('./components/DetailField'));
    Vue.component('form-translatable-textarea', require('./components/FormField'));
    Vue.component('dropdown-menu-translatable-textarea', require('./components/DropdownMenu'));
});
