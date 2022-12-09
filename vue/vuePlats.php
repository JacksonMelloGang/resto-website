<?php
foreach($plats as $plat){
    echo "<div class='plat'>";
        echo "<h2>{$plat['nomP']}</h2>";
        echo "<p>{$plat['descP']}</p>";
        echo "<p>{$plat['prixP']}</p>";
    echo "</div>";

}