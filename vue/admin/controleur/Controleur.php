<?php

require 'modele/modele.class.php';

// Affiche la page d'accueil
function admin() {
    require 'vue/vueadmin.php';
}

function ajout() {
    require 'vue/vueajout.php';
}
function modif(){
    require 'vue/vueModif.php';
}

function erreur() {
    require './vue/vueErreur.php';
}
function suppression(){
    require './vue/vueSuppression.php';
}
function deco(){
    require './vue/vueDeconnexion.php';
}

?>