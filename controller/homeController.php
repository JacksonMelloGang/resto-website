<?php

function home(){
    if(isLoggedOn()){
        header("Location: index.php?action=showRestaurants");
        exit();
    }

    $title = "Resto - Accueil";

    require "vue/vueHome.php";
}

function cgu(){
    $title = "Resto - CGU";

    require "vue/vueCgu.php";
}