<?php

require_once "modele\authentification.inc.php";

function getPlatsFromidR($idR){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("SELECT * FROM plat WHERE idR = :idR");
    $req->bindParam(':idR', $idR);
    $req->execute();

    $plats = $req->fetchAll(PDO::FETCH_ASSOC);

    return $plats;
}

function getPlats(){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("SELECT * FROM plat");
    $req->execute();

    $plats = $req->fetchAll(PDO::FETCH_ASSOC);

    return $plats;
}

function addPlat($nomP, $descP, $prixP, $idR){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("INSERT INTO plat (nomP, descP, prixP, idR) VALUES (:nomP, :descP, :prixP, :idR)");
    $req->bindParam(':nomP', $nomP);
    $req->bindParam(':descP', $descP);
    $req->bindParam(':prixP', $prixP);
    $req->bindParam(':idM', $idR);
    $req->execute();
}

function deletePlat($idP){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("DELETE FROM plat WHERE idP = :idP");
    $req->bindParam(':idP', $idP);
    $req->execute();
}