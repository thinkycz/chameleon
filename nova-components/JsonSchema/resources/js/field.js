Nova.booting((Vue, router) => {
    Vue.component('detail-json-schema', require('./components/DetailField'));
    Vue.component('form-json-schema', require('./components/FormField'));
})
