<?php

include "$racine/modele/bd.resto.inc.php";
include "$racine/modele/bd.photo.inc.php";

$title = "Acceuil";
$restostendance = getRestoTendance(5);
$restos = getRestos();

// show page
include("$racine/vue/vueHome.php");

