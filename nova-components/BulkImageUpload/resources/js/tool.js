Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'bulk-image-upload',
            path: '/bulk-image-upload',
            component: require('./components/Tool'),
        },
    ])
})
