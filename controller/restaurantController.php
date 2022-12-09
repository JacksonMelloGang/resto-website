<?php

include_once "{$GLOBALS['racine']}/model/bd.resto.inc.php";
include_once "{$GLOBALS['racine']}/model/bd.typecuisine.inc.php";
include_once "{$GLOBALS['racine']}/model/bd.photo.inc.php";
include_once "{$GLOBALS['racine']}/model/bd.critiquer.inc.php";
include_once "{$GLOBALS['racine']}/model/bd.aimer.inc.php";
include_once "{$GLOBALS['racine']}/model/authentification.inc.php";

function showRestaurants(){
    $title = "Liste Des Restaurants";
    $restostendance = getRestoTendance(5);
    $restos = getRestos();
    
    // show page
    include("{$GLOBALS['racine']}/vue/vueRestaurants.php");    
}

function showRestaurant(){
    $idR = filter_input(INPUT_GET, 'idR', FILTER_SANITIZE_NUMBER_INT);

    $unResto = getRestoByIdR($idR);

    $lesTypesCuisine = getTypesCuisineByIdR($idR);
    $lesPhotos = getPhotosByIdR($idR);
    $noteMoy = getNoteMoyenneByIdR($idR);
    $mailU = getMailULoggedOn();
    $aimer = getAimerById($mailU, $idR);
    $critiques = getCritiquerByIdR($idR);
    $hasAlreadyCommented = false;

    // traitement si necessaire des donnees recuperees
    if($noteMoy === null){
        $noteMoy = 0;
    }

    if($critiques === null){
        $critiques = ['pseudoU' => "aucune critique", "", ""];
    }

    foreach($critiques as $critique){
        if($critique['mailU'] === $mailU){
            $hasAlreadyCommented = true;
        }
    }

    $title = "Resto - {$unResto['nomR']}";
    // show page
    include("{$GLOBALS['racine']}/vue/vueRestaurant.php");
}
