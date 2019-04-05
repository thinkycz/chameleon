<template>
    <div>
        <manual-upload></manual-upload>
        <ftp-sync></ftp-sync>
        <endpoint-sync></endpoint-sync>
    </div>
</template>

<script>
    import ManualUpload from './ManualUpload';
    import FtpSync from './FtpSync';
    import EndpointSync from './EndpointSync';

    export default {
        components: {
            ManualUpload,
            FtpSync,
            EndpointSync
        }
    }
</script>