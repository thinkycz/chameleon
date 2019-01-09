Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'google-sheets-importer',
            path: '/google-sheets-importer',
            component: require('./components/Tool'),
        },
    ])
})
