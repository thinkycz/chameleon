Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'jetsoft-shopconnector',
            path: '/jetsoft-shopconnector',
            component: require('./components/Tool'),
        },
        {
            name: 'jetsoft-shopconnector-configure',
            path: '/jetsoft-shopconnector/configure',
            component: require('./components/Configure'),
        },

    ])
});
