<?php

include_once "bd.inc.php";

function getCritiquerByIdR($idR) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select critiquer.*, utilisateur.pseudoU from critiquer, utilisateur where idR=:idR AND critiquer.mailU = utilisateur.mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getCritiquerByIdMailU($mailu, $idR){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from critiquer where mailU=:mailU AND idR=:idR");
        $req->bindValue(':mailU', $mailu, PDO::PARAM_STR);
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        return $ligne;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getNoteMoyenneByIdR($idR) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select avg(note) from critiquer where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    if ($req->rowCount()>0){
        return $resultat["avg(note)"];
    }
    else{
        return 0;
    }
}

function ajouterCritique($idR, $mailU, $note, $commentaire) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO critiquer values (:idR, :mailU, :note, :commentaire)");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':note', $note, PDO::PARAM_INT);
        $req->bindValue(':commentaire', $commentaire, PDO::PARAM_STR);
        
        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function supprimerCritique($idR, $mailU) {
    
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("DELETE from critiquer where idR=:idR AND mailU=:mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function modifierCritique($idR, $mailU, $note, $commentaire) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE critiquer set note=:note, commentaire=:commentaire where idR=:idR AND mailU=:mailU");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, );
        $req->bindValue(':note', $note, PDO::PARAM_INT);
        $req->bindValue(':commentaire', $commentaire, );
        $result = $req->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $result;
}

function getCritiques(){
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select critiquer.*, utilisateur.pseudoU from critiquer, utilisateur where critiquer.mailU = utilisateur.mailU");

        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "\n getCritiquerByIdR(1) : \n";
    print_r(getCritiquerByIdR(1));

    echo "\n getNoteMoyenneByIdR(1) : \n";
    print_r(getNoteMoyenneByIdR(1));

    
}
?>