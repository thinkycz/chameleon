Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'google-sheets-importer',
            path: '/google-sheets-importer',
            component: require('./components/Tool'),
        },
    ]);

    router.addRoutes([
        {
            name: 'google-sheets-importer-configure',
            path: '/google-sheets-importer/configure',
            component: require('./components/Configure'),
        },
    ]);
});
