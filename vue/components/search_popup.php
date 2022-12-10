<!-- SEARCH COMPONENT -->
<div id="search">
    <img src="/resources/img/rechercher.png" alt="Rechercher">
    <div id="search-criteria">

        <form id="searchform">
            <input type="text" placeholder="Rechercher rapide">
            <input type="submit" value="Rechercher">
        </form>
        <a href="index.php?action=recherch&critere=nom">Recherche Avancée</a>

    </div>
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
<!-- END SCRIPT  - END SEARCH COMPONENT -->