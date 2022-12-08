<?php

require_once "{$GLOBALS['racine']}\modele\authentification.inc.php";
require_once "{$GLOBALS['racine']}\modele\bd.utilisateur.inc.php";
require_once "{$GLOBALS['racine']}\modele\bd.resto.inc.php";
require_once "{$GLOBALS['racine']}\modele\bd.typecuisine.inc.php";


function monProfil(){
    if (isLoggedOn()) {
        $mailU = getMailULoggedOn();
        $util = getUtilisateurByMailU($_SESSION['mailU']);

        $mesRestosAimes = getRestosAimesByMailU($_SESSION['mailU']);

        $mesTypeCuisineAimes = getTypesCuisinePreferesByMailU($_SESSION['mailU']);

        require('vue/vueMonProfil.php');
    } else {
        header("Location: ./?action=showLogin");
    }

}

function updateUserProfil(){
    

}

function updateUserPassword(){
    // check http method
    $http_method = $_SERVER['REQUEST_METHOD'];
    if($http_method != "POST"){
        // abort with error code
        throwError("Erreur 405", "HTTP method not allowed", 405);
    }

    // init empty value
    $mdpU = "";

    // get value from form
    $mdpU = filter_input(INPUT_POST, 'mdpU', FILTER_SANITIZE_STRING);
    $mdpU2 = filter_input(INPUT_POST, 'mdpU2', FILTER_SANITIZE_STRING);

    // check if both are null
    if($mdpU == null || $mdpU2 == null){
        return;
    }

    if($mdpU != $mdpU2){
        return;
    }

    // attempt update
    $result = updatePassword($_SESSION["mailU"], $mdpU);
}

function updateUserMail(){
    // check http method
    $http_method = $_SERVER['REQUEST_METHOD'];
    if($http_method != "POST"){
        // abort with error code
        throwError("Erreur 405", "HTTP method not allowed", 405);
    }

    // init empty value
    $mailU = "";

    // get value from form
    $mailU = filter_input(INPUT_POST, 'mailU', FILTER_SANITIZE_EMAIL);

    // check if both are null
    if($mailU == null){
        return;
    }

    // attempt update
    $result = updateEmail($_SESSION["mailU"], $mailU);
}

function updatePseudo(){
    // check http method
    $http_method = $_SERVER['REQUEST_METHOD'];
    if($http_method != "POST"){
        // abort with error code
        throwError("Erreur 405", "HTTP method not allowed", 405);
    }

    // init empty value
    $pseudoU = "";

    // get value from form
    $pseudoU = filter_input(INPUT_POST, 'pseudoU', FILTER_SANITIZE_STRING);

    // check if both are null
    if($pseudoU == null){
        return;
    }

    // attempt update
    $result = updateUsername($_SESSION["mailU"], $pseudoU);
}