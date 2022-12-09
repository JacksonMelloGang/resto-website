<?php
include_once "{$GLOBALS['racine']}/model/bd.aimer.inc.php";

function aimerRestaurant(){
    // recuperation des donnees GET, POST et SESSION
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

function aimerPlat(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // check if user is logged in
        if(isLoggedOn()){
            // check if user has already liked the post
            if(!isLiked($_POST['idP'], $_SESSION['idU'])){
                // add like
                addLike($_POST['idP'], $_SESSION['idU']);
                // redirect to plat page
                header("Location: index.php?action=plat&idP={$_POST['idP']}");
            } else {
                // redirect to plat page
                header("Location: index.php?action=plat&idP={$_POST['idP']}");
            }
        } else {
            // redirect to login page
            header("Location: index.php?action=login");
        }
    } else {
        // redirect to home page
        header("Location: index.php?action=home");
    }
}

function aimerMenu(){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // check if user is logged in
        if(isLoggedOn()){
            // check if user has already liked the post
            if(!isLiked($_POST['idM'], $_SESSION['idU'])){
                // add like
                addLike($_POST['idM'], $_SESSION['idU']);
                // redirect to menu page
                header("Location: index.php?action=menu&idM={$_POST['idM']}");
            } else {
                // redirect to menu page
                header("Location: index.php?action=menu&idM={$_POST['idM']}");
            }
        } else {
            // redirect to login page
            header("Location: index.php?action=login");
        }
    } else {
        // redirect to home page
        header("Location: index.php?action=home");
    }
}