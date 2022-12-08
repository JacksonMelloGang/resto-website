<?php
// INCLUDE MODELE
include_once "{$GLOBALS['racine']}/modele/bd.utilisateur.inc.php";
include "{$GLOBALS['racine']}/controleur/errorController.php";

function showLogin($msg = ""){
    $title = "Login";
    $content = "login";

    require "vue/vueLogin.php";
}

function connect(){
    $http_method = $_SERVER['REQUEST_METHOD'];
    if($http_method != "POST"){
        // abort with error code
        return throwError("Erreur 405", "HTTP method not allowed", 405);
    }

    // init empty value
    $mailU = "";
    $mdpU = "";

    // get value from form
    $mdpU = filter_input(INPUT_POST, 'mdpU', FILTER_SANITIZE_STRING);
    $mailU = filter_input(INPUT_POST, 'mailU', FILTER_SANITIZE_EMAIL);

    // check if both are null
    if($mailU == null || $mdpU == null){
        return;
    }

    // attempt login
    $result = login($mailU, $mdpU);

    if($result == true){
        header("Location: index.php?action=restaurants");
    } else {
        showLogin("Erreur lors de la connexion, Invalid username or password");
    }
}

function disconnect(){
    logout();
    
    header("Location: index.php");
}

function showRegister($msg = ""){
    $title = "Register";
    $content = "register";
    $msg = $msg;

    require "vue/vueRegister.php";
}

function register(){
    // check if method is post method otherwise throw error
    $http_method = $_SERVER['REQUEST_METHOD'];
    if($http_method != "POST"){
        // abort with error code
        throwError("Erreur 405", "HTTP method not allowed", 405);
        return;
    }

    // init empty value
    $mailU = "";
    $mdpU = "";
    $pseudoU = "";

    // get value from form
    $mailU = filter_input(INPUT_POST, 'mailU', FILTER_SANITIZE_EMAIL);
    $mdpU = filter_input(INPUT_POST, 'mdpU', FILTER_SANITIZE_STRING);
    $pseudoU = filter_input(INPUT_POST, 'pseudoU', FILTER_SANITIZE_STRING);

    // check if either are null
    if($mailU == null || $mdpU == null || $pseudoU == null){
        showRegister("Veuillez remplir tous les champs");
        return;
    }

    // attempt register
    $result = addUtilisateur($mailU, $mdpU, $pseudoU, 1);
    login($mailU, $mdpU);
    
    if($result == false){
        showRegister("Erreur lors de l'inscription");
        return;
    }
    header("Location: index.php?action=restaurants");
}