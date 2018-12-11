Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'store',
            path: '/store',
            component: require('./components/Tool'),
        },
    ])
})
