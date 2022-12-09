<?php

require_once "model\authentification.inc.php";

function migrate(){
    $cnx = connexionPDO(); // get pdo connexionPDO()


    // "categories" table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS userrang(
        idrang INT AUTO_INCREMENT PRIMARY KEY,
        libelle VARCHAR(50) NOT NULL
    )");
    $req->execute();

    // typecuisine table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS typecuisine(
        idTC BIGINT AUTO_INCREMENT PRIMARY KEY,
        libelleTC VARCHAR(255) NOT NULL
    )");
    $req->execute();

    // utilisateur table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS utilisateur(
        mailU VARCHAR(150) NOT NULL PRIMARY KEY,
        mdpU VARCHAR(255) NOT NULL,
        pseudoU VARCHAR(255) NOT NULL,
        rangU INT NOT NULL,
        is_banned BOOLEAN NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_rangU FOREIGN KEY (rangU) REFERENCES userrang(idrang)
    )");
    $req->execute();
    
    // resto table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS resto(
        idR BIGINT AUTO_INCREMENT PRIMARY KEY,
        nomR VARCHAR(255) DEFAULT NULL,
        numAdrR VARCHAR(20) DEFAULT NULL,
        voieAdrR VARCHAR(255) DEFAULT NULL,
        cpR char(5) DEFAULT NULL,
        villeR VARCHAR(255) DEFAULT  NULL,
        longitudeDegR FLOAT DEFAULT NULL,
        latitudeDegR FLOAT DEFAULT NULL,
        descR TEXT,
        horairesR TEXT,
        added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )");
    $req->execute();

    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS posseder_resto(
        mailU VARCHAR(150) NOT NULL,
        idR BIGINT NOT NULL,
        CONSTRAINT fk_mailU FOREIGN KEY (mailU) REFERENCES utilisateur(mailU),
        CONSTRAINT fk_idRPO FOREIGN KEY (idR) REFERENCES resto(idR)    
    )");
    $req->execute();

    // photo table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS photo(
        idP BIGINT AUTO_INCREMENT PRIMARY KEY,
        cheminP VARCHAR(255) DEFAULT NULL,
        idR BIGINT DEFAULT NULL,
        uploaded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_idRP FOREIGN KEY(idR) REFERENCES resto(idR)
    )");
    $req->execute();

    // aimer table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS aimer(
        idR BIGINT NOT NULL,
        mailU VARCHAR(150) NOT NULL,
        liked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT pk_idR_mailU PRIMARY KEY (idR, mailU),
        CONSTRAINT fk_idRA FOREIGN KEY (idR) REFERENCES resto(idR),
        CONSTRAINT fk_idUA FOREIGN KEY (mailU) REFERENCES utilisateur(mailU)
    )");
    $req->execute();

    // critiquer table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS critiquer(
        idR BIGINT NOT NULL,
        mailU VARCHAR(150) NOT NULL,
        note INT DEFAULT NULL,
        commentaire VARCHAR(4096) DEFAULT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_idRC FOREIGN KEY (idR) REFERENCES resto(idR),
        CONSTRAINT fk_idUC FOREIGN KEY (mailU) REFERENCES utilisateur(mailU)
    )");
    $req->execute();

    // menu table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS menu(
        idM BIGINT AUTO_INCREMENT PRIMARY KEY,
        nomM VARCHAR(255) NOT NULL,
        descM VARCHAR(300) NOT NULL,
        prixM INT NOT NULL,
        idR BIGINT NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_idRM FOREIGN KEY (idR) REFERENCES resto(idR)
    )");
    $req->execute();

    // plat table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS plat(
        idP BIGINT AUTO_INCREMENT PRIMARY KEY,
        nomP VARCHAR(255) NOT NULL,
        descP VARCHAR(255) NOT NULL,
        prixP NUMERIC(5,2) NOT NULL,
        idM BIGINT NOT NULL,
        idR BIGINT NOT NULL,
        typeCuisine BIGINT DEFAULT NULL,
        added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        CONSTRAINT fk_tCP FOREIGN KEY (typeCuisine) REFERENCES typecuisine(idTC),
        CONSTRAINT fk_idMP FOREIGN KEY (idM) REFERENCES menu(idM),
        CONSTRAINT fk_idRPL FOREIGN KEY (idR) REFERENCES resto(idR)                               
    )");
    $req->execute();

    // proposer table
    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS proposer(
        idR BIGINT NOT NULL,
        idTC BIGINT NOT NULL,
        PRIMARY KEY (idR, idTC),
        CONSTRAINT fk_idP FOREIGN KEY (idTC) REFERENCES typecuisine(idTC),
        CONSTRAINT fk_idRPP FOREIGN KEY (idR) REFERENCES resto(idR)
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

    $req = $cnx->prepare("CREATE TABLE IF NOT EXISTS preferer(
        `mailU` varchar(150) NOT NULL,
        `idTC` bigint NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (`mailU`,`idTC`),
        KEY `fk_idTC` (`idTC`),
        CONSTRAINT `fk_idTCPR` FOREIGN KEY (`idTC`) REFERENCES `typecuisine` (`idTC`),
        CONSTRAINT `fk_mailUPR` FOREIGN KEY (`mailU`) REFERENCES `utilisateur` (`mailU`)                           
    )");
    $req->execute();

    echo("Tables created successfully");
}
