Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'xml-importer',
            path: '/xml-importer',
            component: require('./components/Tool'),
        },
        {
            name: 'xml-importer-configure',
            path: '/xml-importer/configure',
            component: require('./components/Configure'),
        },
    ])
})