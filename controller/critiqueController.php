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
    if(!isLoggedOn()){
        header("Location: index.php?action=showLogin");
        return;
    }

    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $idR = filter_input(INPUT_POST, 'idR', FILTER_SANITIZE_NUMBER_INT);

    if($note == null || $idR == null){
        return;
    }

    ajouterCritique($idR, $_SESSION['mailU'], $note, $commentaire);
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
    if(!isLoggedOn()){
        header("Location: index.php?action=showLogin");
        return;
    }

    if(!isset($_POST['commentaire']) || !isset($_POST['note']) || !isset($_POST['idR'])){
        return;
    }

    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $idR = filter_input(INPUT_POST, 'idR', FILTER_SANITIZE_NUMBER_INT);

    $result = modifierCritique($note, $commentaire, $idR, $_SESSION['mailU']);
    if($result === false){
        showEditCritique("Erreur lors de la modification de la critique");
        return;
    }

    echo("Critique modifiée");
    header("Location: index.php?action=showRestaurant&idR=$idR");
}