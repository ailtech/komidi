<?php

require 'modele/modele.class.php';

// Affiche la page d'accueil
function admin() {
    /** @var TYPE_NAME $cnx */
    $cnx = new Database;
    $donnees = $cnx->requete("SELECT * FROM kdi_spectacle");
    require 'vue/vueadmin.php';
}

function ajout() {
    require 'vue/vueajout.php';
}

function erreur() {
    require './vue/vueErreur.php';
}

?>