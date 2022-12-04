<?php

function controleurPrincipal($action) {
    
    global $registered_routes;

    $registered_routes = array(
        "home" => "homeController",
        "restaurants" => "restaurantController",
        "critiques" => "critiqueController",
        "utilisateurs" => "utilisateurController",
        "photos" => "photoController",
        "login" => "loginController",
        "logout" => "logoutController",
        "register" => "registerController",
        "admin" => "adminController",

        "404" => "errorController"
    );

    $ok = true;

    if(array_key_exists($action, $registered_routes)){
        include("controleur\\" . $registered_routes[$action] . ".php");

        if(function_exists($registered_routes[$action])){
            return array($registered_routes[$action], $action);
        } else {
            $ok = false;
        }
    } else {
        $ok = false; 
    }

    if(!$ok){
        return array("errorController", "error404");
    }


    /**
     
    $lesActions = array();

    $lesActions["accueil"] = "homeController.php";
    $lesActions["liste"] = "restaurantController.php";
    $lesActions["detail"] = "detailRestoController.php";

    $lesActions["recherche"] = "rechercheResto.php";
    $lesActions["cgu"] = "cgu.php";

    $lesActions["profil"] = "monProfil.php";
    $lesActions["aimer"] = "aimer.php";


    $lesActions["connexion"] = "connexionController.php";
    $lesActions["inscription"] = "inscription.php";
    $lesActions["deconnexion"] = "deconnexion.php";

    $lesActions["defaut"] = "listeRestos.php";

    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } 
    else {
        return $lesActions["defaut"];
    }
    */
}

function register_route($action, $controller) {
    global $registered_routes;

    $registered_routes[$action] = $controller;
}

?>