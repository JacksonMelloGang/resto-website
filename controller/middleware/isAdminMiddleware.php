<?php

require_once "model\authentification.inc.php";

function isAdmin(){
    $cnx = connexionPDO(); // get pdo connexionPDO()
    $mailU = getMailULoggedOn();
    
    // get user
    $req = $cnx->prepare("SELECT * FROM utilisateur WHERE mailU = :mailU");
    $req->bindParam(':mailU', $mailU);
    $req->execute();

    $user = $req->fetch(PDO::FETCH_ASSOC);

    // get rang based on userrang id
    $req = $cnx->prepare("SELECT * FROM userrang WHERE id = :idUR");
    $req->bindParam(':idUR', $user['idUR']);
    $req->execute();

    $rang = $req->fetch(PDO::FETCH_ASSOC);

    // check if rang is not null
    if($rang === null){
        return false;
    }

    if($rang['libelle'] == 'Administrateur'){
        return true;
    }

    return false;
}