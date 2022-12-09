<?php

require_once "model\authentification.inc.php";

function seed(){

    $cnx = connexionPDO(); // get pdo connexionPDO()
    $cnx->beginTransaction();


    // add userrang entries in userrang tables
    $req = $cnx->prepare("INSERT INTO userrang(libelle) VALUES('Administrateur')");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO userrang(libelle) VALUES('Modérateur')");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO userrang(libelle) VALUES('Restaurateur')");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO userrang(libelle) VALUES('Utilisateur')");
    $req->execute();

    // add typecuisine entries in typecuisine tables
    $req = $cnx->prepare("INSERT INTO typecuisine(libelle) VALUES('Asiatique')");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO typecuisine(libelle) VALUES('Français')");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO typecuisine(libelle) VALUES('Italien')");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO typecuisine(libelle) VALUES('Japonais')");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO typecuisine(libelle) VALUES('Chinois')");
    $req->execute();

    // add fake entries in utilisateur tables
    $req = $cnx->prepare("INSERT INTO utilisateur(mailU, mdpU, pseudoU, idUR, is_banned) VALUES('abde@gmail.com', 'seSzpoUAQgIl.', 'abde', 1, 0)");
    $req->execute();

    // add fake entries in resto tables
    $req = $cnx->prepare("INSERT INTO resto(nomR, numAdrR, voieAdrR, cpR, villeR, latitudeDegR, latitudeMinR, descR, horaireR) VALUES('Le Bistrot', '1', 'rue de la paix', '75000', 'Paris', 48, 51, 'Un restaurant de qualité', '10h-22h')");
    $req->execute();
    

    // add photo entries in photo tables
    $req = $cnx->prepare("INSERT INTO photo(cheminP, idR) VALUES('img/restaurant/1.jpg', 1)");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO photo(cheminP, idR) VALUES('img/restaurant/2.jpg', 1)");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO photo(cheminP, idR) VALUES('img/restaurant/3.jpg', 1)");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO photo(cheminP, idR) VALUES('img/restaurant/4.jpg', 1)");
    $req->execute();

    // add aimer entries in aimer tables
/*    $req = $cnx->prepare("INSERT INTO aimer(mailU, idR) VALUES(1, 1)");
    $req->execute();*/

    // add critiquer entries in critiquer tables
    $req = $cnx->prepare("INSERT INTO critiquer(idR, mailU, note, commentaire) VALUES(1, 1, 4, 'Un bon restaurant')");
    $req->execute();

    // add menu entries in menu tables
    $req = $cnx->prepare("INSERT INTO menu(nomM, descM, prixM, idR) VALUES('Menu 1', 'Menu Desc 1', 10, 1)");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO menu(nomM, descM, prixM, idR) VALUES('Menu 2', 'Menu Desc 2', 15, 1)");
    $req->execute();

    // add plat entries in plat tables
    $req = $cnx->prepare("INSERT INTO plat(nomP, descP, prixP, idM, idR) VALUES('Plat 1', 'Plat Desc 1', 10, 1, 1)");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO plat(nomP, descP, prixP, idM, idR) VALUES('Plat 2', 'Plat Desc 2', 15, 1, 1)");
    $req->execute();
    $req = $cnx->prepare("INSERT INTO plat(nomP, descP, prixP, idM, idR) VALUES('Plat 3', 'Plat Desc 3', 20, 2, 1)");
    $req->execute();

    // commit transaction if no error
    $cnx->commit();
}