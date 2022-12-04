<?php

include_once "{$GLOBALS['racine']}/modele/bd.resto.inc.php";
include_once "{$GLOBALS['racine']}/modele/bd.typecuisine.inc.php";
include_once "{$GLOBALS['racine']}/modele/bd.photo.inc.php";
include_once "{$GLOBALS['racine']}/modele/bd.critiquer.inc.php";
include_once "{$GLOBALS['racine']}/modele/bd.aimer.inc.php";
include_once "{$GLOBALS['racine']}/modele/authentification.inc.php";
function restaurants(){
    $title = "Liste Des Restaurants";
    $restostendance = getRestoTendance(5);
    $restos = getRestos();
    
    // show page
    include("{$GLOBALS['racine']}/vue/vueRestaurants.php");    
}

function restaurant(){
    $idR = filter_input(INPUT_GET, 'idR', FILTER_SANITIZE_NUMBER_INT);

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

    // show page
    include("{$GLOBALS['racine']}/vue/vueRestaurant.php");
}
