<?php

include "$racine/modele/bd.resto.inc.php";
include "$racine/modele/bd.critiquer.php";

$title = "Acceuil";

// filter post_values first
$note = filter_input(INPUT_POST, 'note', FILTER_SANITIZE_NUMBER_INT);
$commentaire = htmlspecialchars($_POST['commentaire']);
$idR = filter_input(INPUT_POST, 'idR', FILTER_SANITIZE_NUMBER_INT);
$mailU = filter_input(INPUT_POST, 'mailU', FILTER_SANITIZE_EMAIL);


switch($_POST['func']){
    case "ajouterCritique":
        ajouterCritique($_POST['idR'], $_POST['mailU'], $_POST['note'], $_POST['commentaire']);
        break;

    case "supprimerCritique":
        supprimerCritique($_POST['idR'], $_POST['mailU']);
        break;

    case "modifierCritique":
        modifierCritique($_POST['idR'], $_POST['mailU'], $_POST['note'], $_POST['commentaire']);
        break;

    default:
    

    break;
}