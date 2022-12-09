<?php

if($plat){
    echo "<div class='plat'>";
        echo "<h2>{$plat['nomP']}</h2>";
        echo "<p>{$plat['descP']}</p>";
        echo "<p>{$plat['prixP']}</p>";
        echo "<a href='index.php?action=showRestaurant&idR={$plat['idR']}'>En savoir plus sur le restaurant</a><br><br>";
        echo "<a href='index.php?action=showMenu&idR={$plat['idM']}'>En savoir plus sur le menu</a>";
    echo "</div>";
} else {
    echo "<div class='plat'>";
        echo "<h2>Plat introuvable</h2>";
    echo "</div>";
}
