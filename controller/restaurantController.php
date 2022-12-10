<?php

include_once "{$GLOBALS['racine']}/model/bd.plat.inc.php";
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

    if($idR == null){
        showRestaurants();
        return;
    }

    $unResto = getRestoByIdR($idR);

    // get list of plats made by this restaurant
    $lesPlats = getPlatsByIdR($idR);
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

    foreach($critiques as $critique){
        if($critique['mailU'] === $mailU){
            $hasAlreadyCommented = true;
        }
    }


    // show page
    $title = "Resto - {$unResto['nomR']}";
    include("{$GLOBALS['racine']}/vue/vueRestaurant.php");
}
