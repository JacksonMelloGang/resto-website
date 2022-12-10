<?php

include_once "bd.inc.php";

function getRestoByIdR($idR) {

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where idR=:idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);

        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


function getRestos() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto");
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



function getRestosByNomR($nomR) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where nomR like :nomR");
        $req->bindValue(':nomR', "%".$nomR."%", PDO::PARAM_STR);

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

function getRestosByAdresse($voieAdrR, $cpR, $villeR) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from resto where voieAdrR like :voieAdrR and cpR like :cpR and villeR like :villeR");
        $req->bindValue(':voieAdrR', "%".$voieAdrR."%", PDO::PARAM_STR);
        $req->bindValue(':cpR', $cpR."%", PDO::PARAM_STR);
        $req->bindValue(':villeR', "%".$villeR."%", PDO::PARAM_STR);
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



function getRestosAimesByMailU($mailU) {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select resto.* from resto,aimer where resto.idR = aimer.idR and mailU = :mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
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

function getRestoTendance($numberresto){
    $resultat = array();
    $resultatlike = array();

    try {
        $cnx = connexionPDO();

        $getmostlikestmt = $cnx->prepare("select idR, count(idR) as nb from aimer group by idR order by nb desc limit 0, :numberresto");
        $getmostlikestmt->bindValue(':numberresto', $numberresto, PDO::PARAM_INT);
        $getmostlikestmt->execute();

        $getmostlike = $getmostlikestmt->fetch(PDO::FETCH_ASSOC);
        while ($getmostlike) {
            $resultatlike[] = $getmostlike;
            $getmostlike = $getmostlikestmt->fetch(PDO::FETCH_ASSOC);
        }

        foreach ($resultatlike as $key => $value) {
            $getrestostmt = $cnx->prepare("select resto.*, photo.cheminP from resto, photo where resto.idR = :idR AND resto.idR = photo.idR");
            $getrestostmt->bindValue(':idR', $value['idR'], PDO::PARAM_INT);
            $getrestostmt->execute();

            $getresto = $getrestostmt->fetch(PDO::FETCH_ASSOC);
            while ($getresto) {
                $resultat[] = $getresto;
                $getresto = $getrestostmt->fetch(PDO::FETCH_ASSOC);
            }
        }

        return $resultat;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function addResto($nomR, $numAdrR, $voieAdrR, $cpR, $villeR, $longitudeR, $latitudeR, $descR, $horairesR) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT into resto(nomR, numAdrR, voieAdrR, cpR, villeR, longitudeDegR, latitudeDegR, descR, horairesR) values(:nomR, :numAdrR, :voieAdrR, :cpR, :villeR, :longitudeDegR, :latitudeDegR, :descR, :horairesR)");
        $req->bindValue(':nomR', $nomR, PDO::PARAM_STR);
        $req->bindValue(':numAdrR', $numAdrR, PDO::PARAM_INT);
        $req->bindValue(':voieAdrR', $voieAdrR, PDO::PARAM_STR);
        $req->bindValue(':cpR', $cpR, PDO::PARAM_STR);
        $req->bindValue(':villeR', $villeR, PDO::PARAM_STR);
        $req->bindValue(':longitudeDegR', $longitudeR, PDO::PARAM_STR);
        $req->bindValue(':latitudeDegR', $latitudeR, PDO::PARAM_STR);
        $req->bindValue(':descR', $descR, PDO::PARAM_STR);
        $req->bindValue(':horairesR', $horairesR, PDO::PARAM_STR);
        $result = $req->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $result;
}

function delResto($idR){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("DELETE from resto where idR = :idR");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $result = $req->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $result;
}

function giveOwnerResto($idR, $mailU){
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT into posseder_resto(idR, mailU) values(:idR, :mailU)");
        $req->bindValue(':idR', $idR, PDO::PARAM_INT);
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $result = $req->execute();

    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }

    return $result;
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    // prog principal de test
    header('Content-Type:text/plain');

    echo "getRestos() : \n";
    print_r(getRestos());

    echo "getRestoByIdR(1) : \n";
    print_r(getRestoByIdR(1));

    echo "getRestosByNomR('charcut') : \n";
    print_r(getRestosByNomR("charcut"));

    echo "getRestosByAdresse(voieAdrR, cpR, villeR) : \n";
    print_r(getRestosByAdresse("Ravel", "33000", "Bordeaux"));
    
    echo "getRestosAimesByMailU(mailU) : \n";
    print_r(getRestosAimesByMailU("test@bts.sio"));
}
?>