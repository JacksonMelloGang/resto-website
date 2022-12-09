<?php

require_once "{$GLOBALS['racine']}\model\authentification.inc.php";
require_once "{$GLOBALS['racine']}\model\bd.utilisateur.inc.php";
require_once "{$GLOBALS['racine']}\model\bd.resto.inc.php";
require_once "{$GLOBALS['racine']}\model\bd.typecuisine.inc.php";


function monProfil(){
    if (isLoggedOn()){
        $mailU = getMailULoggedOn();
        $util = getUtilisateurByMailU($_SESSION['mailU']);

        $mesRestosAimes = getRestosAimesByMailU($_SESSION['mailU']);

        $mesTypeCuisineAimes = getTypesCuisinePreferesByMailU($_SESSION['mailU']);

        $title = "Mon profil";
        require('vue/vueMonProfil.php');
    } else {
        header("Location: ./?action=showLogin");
    }

}

function editPassword($msg = ""){
    if (isLoggedOn()){
        $title = "Modifier mon mot de passe";

        require('vue/vueEditPassword.php');
    } else {
        header("Location: ./?action=showLogin");
    }
}

function editUsername($msg = ""){
    if (isLoggedOn()){
        $title = "Modifier mon pseudo";
        $pseudo = getUtilisateurByMailU($_SESSION['mailU'])['pseudoU'];

        require('vue/vueEditUsername.php');
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

    // check if user is logged on
    if(!isLoggedOn()){
        header("Location: ./?action=showLogin");
    }

    // init empty value
    $mdpU = "";

    // get value from form
    $mdpU = htmlspecialchars($_POST['mdpU']);
    $mdpU2 = htmlspecialchars($_POST['mdpU2']);

    // check if both are null
    if($mdpU == null || $mdpU2 == null){
        editPassword("Veuillez remplir tous les champs");
        return;
    }

    // check if both are equal
    if($mdpU != $mdpU2){
        editPassword("Les mots de passe ne correspondent pas");
        return;
    }

    // attempt update
    $result = updatePassword($_SESSION["mailU"], $mdpU);
    if($result){
        header("Location: ./?action=monProfil");
    } else {
        editPassword("Erreur lors de la modification du mot de passe");
    }
}

function updateUserMail(){
    // check http method
    $http_method = $_SERVER['REQUEST_METHOD'];
    if($http_method != "POST"){
        // abort with error code
        throwError("Erreur 405", "HTTP method not allowed", 405);
    }

    if(!isLoggedOn()){
        header("Location: ./?action=showLogin");
        return;
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

    // update mail in session if update was successful
    if($result !== false){
        $_SESSION["mailU"] = $mailU;
    }
}

function updatePseudo(){
    // check http method
    $http_method = $_SERVER['REQUEST_METHOD'];
    if($http_method != "POST"){
        // abort with error code
        throwError("Erreur 405", "HTTP method not allowed", 405);
        return;
    }

    if(!isLoggedOn()){
        header("Location: ./?action=showLogin");
        return;
    }

    // init empty value
    $pseudoU = "";

    // get value from form
    $pseudoU = htmlspecialchars($_POST['pseudoU']);

    // check if both are null
    if($pseudoU == null){
        editUsername("Veuillez remplir tous les champs");
    }

    // attempt update
    $result = updateUsername($_SESSION["mailU"], $pseudoU);
    if($result === false){
        editUsername("Impossible de modifier le pseudo");
    } else {
        editUsername("Votre pseudo a bien été modifié");
    }
}