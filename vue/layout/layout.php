<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= $title ?></title>
        <link rel="stylesheet" href="/css/style.css">
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

        <!-- SCRIPT -->
        <script>
            document.getElementById("search").onmouseover = function() {mouseOver()};
            document.getElementById("search").onmouseout = function() {mouseOut()};

            function mouseOver() {
                document.getElementById("search-criteria").style.display = "block";
            }

            function mouseOut() {
                document.getElementById("search-criteria").style.display = "none";
            }
        </script>
    </body>
</html>