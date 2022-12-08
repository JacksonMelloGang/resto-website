<?php
include_once "{$GLOBALS['racine']}/modele/bd.aimer.inc.php";

function aimer(){
    // recuperation des donnees GET, POST, et SESSION
    $idR = $_GET["idR"];

    // appel des fonctions permettant de recuperer les donnees utiles a l'affichage 

    $mailU = getMailULoggedOn();
    if ($mailU != "") {
        $aimer = getAimerById($mailU, $idR);

        // traitement si necessaire des donnees recuperees
        
        if ($aimer == false) {
            addAimer($mailU, $idR);
        } else {
            delAimer($mailU, $idR);
        }
    }

    // redirection vers le referer
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>