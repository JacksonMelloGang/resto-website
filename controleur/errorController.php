<?php

if ( $_SERVER["SCRIPT_FILENAME"] == __FILE__ ){
    $racine="..";
}

function throwError($error, $errormessage, $errorcode=405){
    http_response_code($errorcode);


    include "{$GLOBALS['racine']}/vue/vueError.php";
}

function error404() {
    $title = "Erreur 404";
    $error = "Erreur 404";
    $errormessage = "Erreur 404 - La page demandé n'a pas été trouvée.";
    http_response_code(405);

    include "{$GLOBALS['racine']}/vue/vueError.php";
}

function missingFunction($action, $filename) {
    $title = "Erreur 404";
    $error = "MISSING FUNCTION";
    $errormessage = "Erreur 404 - La fonction <em><strong>{$action}</strong></em> demandé dans le Controller <em><strong>{$filename}</em></strong> n'a pas été trouvée.";
    http_response_code(404);

    include "{$GLOBALS['racine']}/vue/vueError.php";
}

function missingRoute($action) {
    $title = "Erreur 404";
    $error = "MISSING ROUTE";
    $errormessage = "Erreur 404 - La route <em><strong>$action</strong></em> demandé n'a pas été trouvée.";

    include "{$GLOBALS['racine']}/vue/vueError.php";
}

function missingModele($action) {
    $title = "Erreur 404";
    $error = "MISSING MODELE";
    $errormessage = "Erreur 404 - Le modèle <em><strong>$action</strong></em> demandé n'a pas été trouvée.";

    include "{$GLOBALS['racine']}/vue/vueError.php";
}

function missingVue($action) {
    $title = "Erreur 404";
    $error = "MISSING VUE";
    $errormessage = "Erreur 404 - La vue <em><strong>$action</strong></em> demandé n'a pas été trouvée.";

    include "{$GLOBALS['racine']}/vue/vueError.php";
}

?>