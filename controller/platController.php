<?php

include_once "{$GLOBALS['racine']}/model/bd.plat.inc.php";
include_once "{$GLOBALS['racine']}/controller/errorController.php";

function showPlats(){
    $plats = getPlats();
    $title = "Resto - Plats";

    require('vue/vuePlats.php');
}

function showPlat(){

    if(!isset($_GET['idP'])){
        throwError("MISSING VALUE", "The key <strong>idR</strong> in the URL is missing !", 400);
        return;
    }

    $idP = $_GET['idP'];
    // filter idP
    if(!filter_var($idP, FILTER_VALIDATE_INT)){
        throwError("INVALID VALUE", "The key <strong>idP</strong> in the URL is invalid !", 400);
        return;
    }

    $plat = getPlat($idP);
    $title = "Resto - Plat";

    require('vue/vuePlat.php');
}

