<?php

require_once "model\authentification.inc.php";

function migrate(){
    $cnx = connexionPDO(); // get pdo connexionPDO()


    // "categories" table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS userrang(
        id INT AUTO_INCREMENT PRIMARY KEY,
        libelle VARCHAR(50) NOT NULL
    )");
    $req->execute();

    // typecuisine table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS typecuisine(
        id INT AUTO_INCREMENT PRIMARY KEY,
        libelle VARCHAR(255) NOT NULL
    )");
    $req->execute();

    // utilisateur table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS utilisateur(
        idU INT AUTO_INCREMENT PRIMARY KEY,
        mailU VARCHAR(255) NOT NULL,
        mdpU VARCHAR(255) NOT NULL,
        pseudoU VARCHAR(255) NOT NULL,
        idUR INT NOT NULL,
        is_banned BOOLEAN NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_idUR FOREIGN KEY (idUR) REFERENCES userrang(id)
    )");
    $req->execute();
    
    // resto table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS resto(
        idR INT AUTO_INCREMENT PRIMARY KEY,
        nomR VARCHAR(255) NOT NULL,
        numAdrR VARCHAR(255) NOT NULL,
        voieAdrR VARCHAR(255) NOT NULL,
        cpR VARCHAR(255) NOT NULL,
        villeR VARCHAR(255) NOT NULL,
        latitudeDegR INT,
        latitudeMinR INT,
        descR VARCHAR(255) NOT NULL,
        horaireR VARCHAR(255) NOT NULL,
        added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $req->execute();

    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS posseder_resto(
        mailU VARCHAR(255) NOT NULL,
        idR INT NOT NULL,
        CONSTRAINT fk_mailU FOREIGN KEY (mailU) REFERENCES utilisateur(mailU),
        CONSTRAINT fk_idR FOREIGN KEY (idR) REFERENCES resto(idR)    
    )");
    $req->execute();

    // photo table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS photo(
        idP INT AUTO_INCREMENT PRIMARY KEY,
        cheminP VARCHAR(255) NOT NULL,
        idR INT NOT NULL,
        uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_idR FOREIGN KEY (idR) REFERENCES resto(idR)
    )");
    $req->execute();

    // aimer table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS aimer(
        idR INT NOT NULL,
        mailU VARCHAR(150) NOT NULL,
        liked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT pk_idR_mailU PRIMARY KEY (idR, mailU),
        CONSTRAINT fk_idR FOREIGN KEY (idR) REFERENCES resto(idR),
        CONSTRAINT fk_idU FOREIGN KEY (mailU) REFERENCES utilisateur(mailU)
    )");
    $req->execute();

    // critiquer table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS critiquer(
        idR INT NOT NULL,
        mailU INT NOT NULL,
        note INT,
        commentaire VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_idR FOREIGN KEY (idR) REFERENCES resto(idR),
        CONSTRAINT fk_idU FOREIGN KEY (mailU) REFERENCES utilisateur(mailU)
    )");
    $req->execute();

    // menu table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS menu(
        idM INT AUTO_INCREMENT PRIMARY KEY,
        nomM VARCHAR(255) NOT NULL,
        descM VARCHAR(255) NOT NULL,
        prixM INT NOT NULL,
        idR INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_idR FOREIGN KEY (idR) REFERENCES resto(idR)
    )");
    $req->execute();

    // plat table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS plat(
        idP INT AUTO_INCREMENT PRIMARY KEY,
        nomP VARCHAR(255) NOT NULL,
        descP VARCHAR(255) NOT NULL,
        prixP NUMERIC(5,2) NOT NULL,
        idM INT NOT NULL,
        idR INT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_idM FOREIGN KEY (idM) REFERENCES menu(idM),
        CONSTRAINT fk_idR FOREIGN KEY (idR) REFERENCES resto(idR)                               
    )");
    $req->execute();


    // failed job table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS failed_jobs(
        id INT AUTO_INCREMENT PRIMARY KEY,
        connection VARCHAR(255) NOT NULL,
        queue VARCHAR(255) NOT NULL,
        payload LONGTEXT NOT NULL,
        exception LONGTEXT NOT NULL,
        failed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $req->execute();
}
