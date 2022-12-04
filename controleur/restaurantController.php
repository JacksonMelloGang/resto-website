<?php

include "$racine/modele/bd.resto.inc.php";
include "$racine/modele/bd.photo.inc.php";

$title = "Liste Des Restaurants";
$restostendance = getRestoTendance(5);
$restos = getRestos();

// show page
include("$racine/vue/vueRestaurants.php");