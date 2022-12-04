<?php
function controleurPrincipal($action) {
    $lesActions = array();

    $lesActions["accueil"] = "restoController.php";
    $lesActions["liste"] = "listeRestos.php";
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
}

?>