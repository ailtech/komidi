<?php

require './modele/modele.class.php';

// Affiche la page d'accueil
function accueil() {
    require './vue/vueAccueil.php';
}
function login(){
    require './vue/vueLogin.php';
}

function erreur() {
    require './vue/vueErreur.php';
}
function connec(){

    header('Location:./admin/administration.php');
}
?>