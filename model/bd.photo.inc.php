<?php

include_once "bd.inc.php";

function getPhotosByIdR($idR) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from photo where idR=:idR");
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

function addPhoto($chemin, $idR){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO photo (chemin, idR) values (:chemin, :idR)");
        $req->bindValue(':chemin', $chemin, PDO::PARAM_STR);
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function deletePhoto($idP){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("DELETE FROM photo WHERE idP=:idP");
        $req->bindValue(':idP', $idP, PDO::PARAM_INT);

        $resultat = $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "\n getPhotosByIdR(1) : \n";
    print_r(getPhotosByIdR(1));

}
?>