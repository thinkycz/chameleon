Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'xml-importer',
            path: '/xml-importer',
            component: require('./components/Tool'),
        },
    ])
})
