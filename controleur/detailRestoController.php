<?php

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.resto.inc.php";
include_once "$racine/modele/bd.typecuisine.inc.php";
include_once "$racine/modele/bd.photo.inc.php";
include_once "$racine/modele/bd.critiquer.inc.php";
include_once "$racine/modele/bd.aimer.inc.php";
include_once "$racine/modele/authentification.inc.php";

// recuperation des donnees GET, POST, et SESSION
$idR = $_GET["idR"];

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
$unResto = getRestoByIdR($idR);

$lesTypesCuisine = getTypesCuisineByIdR($idR);
$lesPhotos = getPhotosByIdR($idR);
$noteMoy = getNoteMoyenneByIdR($idR);
$mailU = getMailULoggedOn();
$aimer = getAimerById($mailU, $idR);
$critiques = getCritiquerByIdR($idR);

// traitement si necessaire des donnees recuperees
if($noteMoy === null){
    $noteMoy = 0;
}

if($critiques === null){
    $critiques = ['pseudoU' => "aucune critique", "", ""];
}

// appel du script de vue qui permet de gerer l'affichage des donnees
$titre = "Detail d'un restaurant";

// show page
include("$racine/vue/vueDetailResto.php");
?>