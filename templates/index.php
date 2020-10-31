<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="manifest.json" rel="manifest">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <!-- <script src="assets/js/sw.js"> </script> -->
    <script>
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker
                .register("assets/js/sw.js", {
                    // scope: '/codehub/assets/js/'
                })
                .then(registration => {
                    console.log("ServiceWorker running");
                })
                .catch(err => {
                    console.log(err);
                })
        }
    </script>
</body>

</html>
