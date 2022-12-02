<?php
function controleurPrincipal($action) {
    $lesActions = array();

    $lesActions["accueil"] = "homeController.php";
    $lesActions["detail"] = "detailRestoController.php";

    $lesActions["defaut"] = "listeRestos.php";
    $lesActions["liste"] = "listeRestos.php";
    $lesActions["recherche"] = "rechercheResto.php";
    $lesActions["connexion"] = "connexionController.php";
    $lesActions["deconnexion"] = "deconnexion.php";
    $lesActions["profil"] = "monProfil.php";
    $lesActions["cgu"] = "cgu.php";
    $lesActions["aimer"] = "aimer.php";
    $lesActions["inscription"] = "inscription.php";



    if (array_key_exists($action, $lesActions)) {
        return $lesActions[$action];
    } 
    else {
        return $lesActions["defaut"];
    }
}

?>