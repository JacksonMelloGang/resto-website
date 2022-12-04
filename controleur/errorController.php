<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}

function error404($racine) {
    $title = "Erreur 404";
    include "$racine/vue/vueError404.php";
}