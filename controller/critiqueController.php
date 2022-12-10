<?php

include_once "{$GLOBALS['racine']}/model/bd.resto.inc.php";
include_once "{$GLOBALS['racine']}/model/bd.critiquer.inc.php";

function showEditCritique($msg = ""){
    if(!isLoggedOn()){
        header("Location: index.php?action=showLogin");
        return;
    }

    $idR = filter_input(INPUT_GET, 'idR', FILTER_SANITIZE_NUMBER_INT);
    $mailU = getMailULoggedOn();

    if($idR == null){
        showRestaurants();
        return;
    }

    $critique = getCritiquerByIdR($idR);

    if($critique == null){
        showRestaurant();
        return;
    }

    foreach($critique as $uneCritique) {
        if($uneCritique['mailU'] == $mailU){
            $critique = $uneCritique;
            break;
        }
    }

    $title = "Modifier critique";
    // show page
    include("{$GLOBALS['racine']}/vue/vueEditCritique.php");
}

function addCritique(){
    // if not logged on, redirect to login page
    if(!isLoggedOn()){
        header("Location: index.php?action=showLogin");
        return;
    }

    // sanitize input
    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $idR = filter_input(INPUT_POST, 'idR', FILTER_SANITIZE_NUMBER_INT);

    // check if input is valid
    if($note == null || $idR == null){
        return;
    }

    // add Critique
    ajouterCritique($idR, $_SESSION['mailU'], $note, $commentaire);

    // redirect to restaurant page
    header("Location: index.php?action=showRestaurant&idR=$idR");
}

function delCritique(){
    if(!isLoggedOn()){
        header("Location: index.php?action=showLogin");
        return;
    }

    $idR = filter_input(INPUT_GET, 'idR', FILTER_SANITIZE_NUMBER_INT);
    
    supprimerCritique($idR, $_SESSION['mailU']);
    header("Location: index.php?action=showRestaurant&idR=$idR");
}

function editCritique(){
    // if not logged on, redirect to login page
    if(!isLoggedOn()){
        header("Location: index.php?action=showLogin");
        return;
    }

    // if missing parameters, redirect to showRestaurants
    if(!isset($_POST['commentaire']) || !isset($_POST['note']) || !isset($_POST['idR'])){
        header("Location: index.php?action=showRestaurants");
        return;
    }

    // sanitize parameters
    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $idR = filter_input(INPUT_POST, 'idR', FILTER_SANITIZE_NUMBER_INT);

    // if parameters are null, redirect to showRestaurants
    if($note == null || $idR == null){
        header("Location: index.php?action=showRestaurants");
        return;
    }

    // update critique
    $result = modifierCritique($idR, getMailULoggedOn(), $note, $commentaire, $idR, $_SESSION['mailU']);

    // if update failed, redirect to old page with error message
    if($result === false){
        showEditCritique("Erreur lors de la modification de la critique");
        return;
    }

    // redirect to showRestaurant
    echo("Critique modifiée");
    header("Location: index.php?action=showRestaurant&idR=$idR");
}