<?php
include "getRacine.php";
include "$racine/controleur/controleurPrincipal.php";
include_once "$racine/modele/authentification.inc.php"; // pour pouvoir utiliser isLoggedOn()

if (isset($_GET["action"])) {
    global $registered_routes;

    // check if route is registered
    if (array_key_exists($_GET["action"], $registered_routes)){
        $action = $_GET["action"];
    } else {
        $action = "404";
    }
    
} else {
    $action = "defaut";
}

$route = controleurPrincipal($action);
include "$racine\\controleur\\$route[0].php";
call_user_func_array($route[1], array($racine));

?>
     