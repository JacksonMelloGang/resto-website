<?php

require_once "model\authentification.inc.php";

function getPlatsByIdR($idR){
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

function getPlat($idP){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("SELECT * FROM plat WHERE idP = :idP");
    $req->bindParam(':idP', $idP);
    $req->execute();

    $plat = $req->fetch(PDO::FETCH_ASSOC);

    return $plat;
}

function addPlat($nomP, $descP, $prixP, $idM, $idR){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("INSERT INTO plat (nomP, descP, prixP, idM, idR) VALUES (:nomP, :descP, :prixP, :idM, :idR)");
    $req->bindParam(':nomP', $nomP);
    $req->bindParam(':descP', $descP);
    $req->bindParam(':prixP', $prixP);
    $req->bindParam(':idM', $idM);
    $req->bindParam(':idR', $idR);
    $req->execute();
}

function deletePlat($idP){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("DELETE FROM plat WHERE idP = :idP");
    $req->bindParam(':idP', $idP);
    $req->execute();
}