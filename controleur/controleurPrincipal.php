<?php

/**
 * Will always return an array of 2 elements: the controller (filename) & the function (name)
 * @param string $action
 * @return array
 */
function controleurPrincipal($action) {
    
    global $registered_routes;

    $registered_routes = array(
        "home" => "homeController",
        "restaurants" => "restaurantController",
        "restaurant" => "restaurantController",

        "addCritique" => "critiqueController",
        "delCritique" => "critiqueController",
        "editCritique" => "critiqueController",

        "aimer" => "aimerController",

        "users" => "utilisateurController",
        "user" => "utilisateurController",

        "photos" => "photoController",

        "showLogin" => "authenticationController",
        "connect" => "authenticationController",
        "disconnect" => "authenticationController",
        "register" => "authenticationController",
        "admin" => "adminController",

        "404" => "errorController",
        "missingFunction" => "errorController",
        "missingRoute" => "errorController",
        "missingModele" => "errorController",
        "missingVue" => "errorController"
    );

    // if route is registered
    if(array_key_exists($action, $registered_routes)){
        require("controleur\\" . $registered_routes[$action] . ".php");

        if(function_exists($action)){
            // controller and function exist - normal operation
            return array($registered_routes[$action], $action);
        } else {
            // function not exist
            return array("errorController", "missingFunction");
        }
    } else {
        // route not exist
        return array("errorController", "error404");
    }
}

function register_route($action, $controller) {
    global $registered_routes;

    $registered_routes[$action] = $controller;
}

function get_controller($action) {
    global $registered_routes;

    if(array_key_exists($action, $registered_routes)){
        return $registered_routes[$action];
    } else {
        return null;
    }
}

?>