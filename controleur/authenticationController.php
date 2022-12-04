<?php
// INCLUDE MODELE
include_once "{$GLOBALS['racine']}/modele/authentification.inc.php";
include "{$GLOBALS['racine']}/controleur/errorController.php";

function showLogin(){
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
    $mailU = filter_input(INPUT_POST, 'mailU', FILTER_SANITIZE_EMAIL);
    $mdpU = filter_input(INPUT_POST, 'mdpU', FILTER_SANITIZE_STRING);

    // check if both are null
    if($mailU == null || $mdpU == null){
        return;
    }

    // attempt login
    $result = login($mailU, $mdpU);
}

function disconnect(){

}

/**
if ($http_method == 'GET') {
    $action = $_GET['action'];
} else if ($http_method == 'POST') {
    // POST METHOD = TRY TO LOGIN
    $mailU = "";
    $mdpU = "";

    if(isset($_POST["mailU"]) && isset($_POST["mdpU"])) {
        $mailU = $_POST["mailU"];
        $mdpU = $_POST["mdpU"];
    }

    login($mailU, $mdpU);
}






// traitement si necessaire des donnees recuperees
if($attemptlogin){
    login($mailU,$mdpU);
}

if (isLoggedOn()){ // si l'utilisateur est connecté on redirige vers le controleur monProfil
    include "$racine/controleur/monProfil.php";
}
else{ // l'utilisateur n'est pas connecté, on affiche le formulaire de connexion
    // appel du script de vue 
    $titre = "authentification";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueAuthentification.php";
    include "$racine/vue/pied.html.php";
}

?>
**/