<?php

include_once "bd.inc.php";

function getUtilisateurs() {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from utilisateur");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();

        addFailedJobsIntoTable($cnx, $e->getMessage(), "SELECT * FROM utilisateur", $e->getMessage());
        throwError("SQL EXCEPTION", "Une erreur est survenue lors de la récupération des utilisateurs\n{$e->getMessage()}", 500);
        die();
    }
    return $resultat;
}

function getUtilisateurByMailU($mailU) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from utilisateur where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getUsernameByMailU($mailU) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select pseudoU from utilisateur where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $resultat["pseudoU"];
}

function addUtilisateur($mailU, $mdpU, $pseudoU, $rang = 0) {
    try {
        $cnx = connexionPDO();

        $mdpUCrypt = crypt($mdpU, "sel");
        $req = $cnx->prepare("insert into utilisateur (mailU, mdpU, pseudoU, rangU) values(:mailU,:mdpU,:pseudoU,:rangU)");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':mdpU', $mdpUCrypt, PDO::PARAM_STR);
        $req->bindValue(':pseudoU', $pseudoU, PDO::PARAM_STR);
        $req->bindValue(':rangU', $rang, PDO::PARAM_INT);
        
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getUtilisateurRang($mailU){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select rangU from utilisateur where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $resultat["rangU"];
}

function isBanned($mailU){
    $banned = false;

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select is_banned from utilisateur where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
        if ($resultat["is_banned"] == 1) {
            $banned = true;
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $banned;
}

function banUser($mailU){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("update utilisateur set is_banned = 1 where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $resultat["rangU"];
}

function unbanUser($mailU){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("update utilisateur set is_banned = 0 where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $result = $req->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $result;
}

function updatePassword($mailU, $mdp){
    try {
        $cnx = connexionPDO();
        $mdpUCrypt = crypt($mdp, "sel");
        $req = $cnx->prepare("update utilisateur set mdpU = :mdpU where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':mdpU', $mdpUCrypt, PDO::PARAM_STR);
        $resultat = $req->execute();
        
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $resultat;
}

function updateUsername($mailU, $pseudo){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE utilisateur set pseudoU = :pseudoU where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':pseudoU', $pseudo, PDO::PARAM_STR);
        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $resultat;
}

function updateEmail($mailU, $newMail){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE utilisateur set mailU = :newMail where mailU=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->bindValue(':newMail', $newMail, PDO::PARAM_STR);
        $result = $req->execute();
        
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    
    return $result;
}

function updateRank($mailU, $userRang){
    // check if userrang exists in userRang table
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM userrang WHERE id = :userRang");
        $req->bindValue(':userRang', $userRang, PDO::PARAM_INT);
        $req->execute();
        $result = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    // if result == true, update user rank
    if ($result) {
        try {
            $cnx = connexionPDO();
            $req = $cnx->prepare("UPDATE utilisateur set rangU = :userRang where mailU=:mailU");
            $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
            $req->bindValue(':userRang', $userRang, PDO::PARAM_INT);
            $result = $req->execute();
            
        } catch (PDOException $e) {
            print "Erreur !: " . $e->getMessage();
            die();
        }
    }
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getUtilisateurs() : \n";
    print_r(getUtilisateurs());

    echo "getUtilisateurByMailU(\"mathieu.capliez@gmail.com\") : \n";
    print_r(getUtilisateurByMailU("mathieu.capliez@gmail.com"));

    echo "addUtilisateur('mathieu.capliez3@gmail.com', 'azerty', 'mat') : \n";
    addUtilisateur("mathieu.capliez3@gmail.com", "azerty", "mat");
}
?>