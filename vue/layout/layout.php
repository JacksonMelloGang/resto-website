<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="/resources/css/style.css">
    </head>
    <body>

        <!-- NAVBAR -->
        <?php include("vue/components/navbar.php") ?>
        <div class="container">
            <!-- PAGE CONTENT -->
            <?= $content ?>

            <!-- FOOTER -->
            <?php include("vue/components/footer.php") ?>
        </div>



        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB-EwYxjbFmeccW8uOnGR4dB6_wKkbZaQE&libraries=places"></script>
    </body>
</html>