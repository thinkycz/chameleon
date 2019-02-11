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
        {
            name: 'xml-importer-ftp-configure',
            path: '/xml-importer/ftp/configure',
            component: require('./components/FtpConfigure'),
        },
        {
            name: 'xml-importer-endpoint-configure',
            path: '/xml-importer/endpoint/configure',
            component: require('./components/EndpointConfigure'),
        },
    ])
})