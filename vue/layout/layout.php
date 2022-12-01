<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<nav>
    <div id="navcontent">
        <div id="navlogo">
            <img src="/images/logoBarre.png">
        </div>
        <ul>
            <li><a href="/index.html">Accueil</a></li>
            <li><a href="/about.html">Restaurants</a></li>
            <li><a href="/contact.html">Menu</a></li>


            <!--<li><a href="/contact.html">Connexion</a></li>-->
        </ul>
    </div>
</nav>
<div class="container">

    <?= $content ?>

</div>

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