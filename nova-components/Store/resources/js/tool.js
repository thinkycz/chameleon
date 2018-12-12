Nova.booting((Vue, router) => {
    router.addRoutes([
        {
            name: 'store-activate-users',
            path: '/store/activate-users',
            component: require('./components/Tool'),
        },
    ]);
    router.addRoutes([
        {
            name: 'store-process-orders',
            path: '/store/process-orders',
            component: require('./components/Tool'),
        },
    ]);
    router.addRoutes([
        {
            name: 'store-import-products',
            path: '/store/import-products',
            component: require('./components/Tool'),
        },
    ]);
    router.addRoutes([
        {
            name: 'store-export-products',
            path: '/store/export-products',
            component: require('./components/Tool'),
        },
    ]);
    router.addRoutes([
        {
            name: 'store-bulk-image-upload',
            path: '/store/bulk-image-upload',
            component: require('./components/Tool'),
        },
    ]);
});
