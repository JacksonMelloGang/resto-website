<?php
// INCLUDE MODELE
include_once "{$GLOBALS['racine']}/model/bd.utilisateur.inc.php";
include "{$GLOBALS['racine']}/controller/errorController.php";

function showLogin($msg = ""){
    $title = "Se connecter";

    require "vue/vueLogin.php";
}

function connect(){
    $http_method = $_SERVER['REQUEST_METHOD'];
    if($http_method != "POST"){
        // abort with error code
        throwError("Erreur 405", "HTTP method not allowed", 405);
        return;
    }

    // init empty value
    $mailU = "";
    $mdpU = "";

    // get value from form
    $mdpU = htmlspecialchars($_POST['mdpU']);
    $mailU = filter_input(INPUT_POST, 'mailU', FILTER_SANITIZE_EMAIL);

    // check if both are null
    if($mailU == null || $mdpU == null){
        showLogin("Veuillez remplir tous les champs");
        return;
    }

    // attempt login
    $result = login($mailU, $mdpU);

    if($result){
        header("Location: index.php?action=showRestaurants");
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

    // check if values in $_POST are set, if not return;
    if(!isset($_POST['mailU']) || !isset($_POST['mdpU']) || !isset($_POST['pseudoU'])){
        showRegister("Veuillez remplir tous les champs");
        return;
    }

    // get value from form
    $mailU = filter_input(INPUT_POST, 'mailU', FILTER_SANITIZE_EMAIL);
    $mdpU = htmlspecialchars($_POST['mdpU']);
    $pseudoU = htmlspecialchars($_POST['pseudoU']);

    // check if either are null
    if($mailU == null || $mdpU == null || $pseudoU == null){
        showRegister("Veuillez remplir tous les champs");
        return;
    }

    // validate with regex email
    if(!filter_var($mailU, FILTER_VALIDATE_EMAIL)){
        showRegister("Veuillez entrer une adresse mail valide");
        return;
    }

    // attempt register
    $result = addUtilisateur($mailU, $mdpU, $pseudoU, 1);
    login($mailU, $mdpU);
    
    if($result == false){
        showRegister("Erreur lors de l'inscription");
        return;
    }
    header("Location: index.php?action=showRestaurants");
}