<?php

include_once "{$GLOBALS['racine']}/model/bd.resto.inc.php";
include_once "{$GLOBALS['racine']}/model/bd.critiquer.inc.php";


function addCritique(){
    
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

    $idR = filter_input(INPUT_GET, 'idR', FILTER_SANITIZE_NUMBER_INT);
    
    supprimerCritique($idR, $_SESSION['mailU']);
    header("Location: index.php?action=showRestaurant&idR=$idR");
}

function editCritique(){
    $note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
    $commentaire = htmlspecialchars($_POST['commentaire']);
    $idR = filter_input(INPUT_POST, 'idR', FILTER_SANITIZE_NUMBER_INT);
    $mailU = filter_input(INPUT_POST, 'mailU', FILTER_SANITIZE_EMAIL);
    
    modifierCritique($note, $commentaire, $idR, $_SESSION['mailU']);
    header("Location: index.php?action=showRestaurant&idR=$idR");
}