<?php
include "getRacine.php";
include "$racine/controller/controleurPrincipal.php";
include_once "$racine/model/authentification.inc.php"; // pour pouvoir utiliser isLoggedOn()
session_start();

if (isset($_GET["action"])) {
    global $registered_routes;

    $action = $_GET["action"];
    
} else {
    $action = "home";
}

/**
 * @return array $route
 * 
 * Return an array composed of 3 element:
 * 1: controller name
 * 2: function name
*/
$route = controleurPrincipal($action); 
require_once "$racine\\controller\\$route[0].php";

// if error
if($route[0] == "errorController"){
    // error
    if(isset($registered_routes[$action])){
        // if action registered
        call_user_func_array($route[1], array($action, $registered_routes[$action]));
    } else {
        // action not registered
        call_user_func_array($route[1], array($action, "missingRoute"));
    }

} else {
    // normal operation (call function)
    call_user_func($route[1]);    
}

?>
     