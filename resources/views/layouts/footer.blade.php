<script>
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('/serviceworker.js')
        .then(function(registration) {
            console.log('ServiceWorker registered: ', registration);
        }).catch(function(error) {
            console.log('ServiceWorker registration failed: ', error);
        });
    }
</script>
@stack('script')