<?php

require_once "modele\authentification.inc.php";

function getMenusFromIdR($idR){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("SELECT * FROM menu WHERE idR = :idR");
    $req->bindParam(':idR', $idR);
    $req->execute();

    $menus = $req->fetchAll(PDO::FETCH_ASSOC);

    return $menus;
}

function getMenus(){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("SELECT * FROM menu");
    $req->execute();

    $menus = $req->fetchAll(PDO::FETCH_ASSOC);

    return $menus;
}

function addMenu($nomM, $descM, $prixM, $idR){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("INSERT INTO menu (nomM, descM, prixM, idR) VALUES (:nomM, :descM, :prixM, :idR)");
    $req->bindParam(':nomM', $nomM);
    $req->bindParam(':descM', $descM);
    $req->bindParam(':prixM', $prixM);
    $req->bindParam(':idR', $idR);
    $req->execute();
}

function deleteMenu($idM){
    $cnx = connexionPDO(); // get pdo connexionPDO()

    $req = $cnx->prepare("DELETE FROM menu WHERE idM = :idM");
    $req->bindParam(':idM', $idM);
    $req->execute();
}