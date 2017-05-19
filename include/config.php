<?php
/**
 * Ce fichier est un fichier de configuration c'est de elle que parte les specification du site, c'est le deuxiéme centre du programme.
 * @copyright ailtech
 * @author Alexandre Lefevre
 * @author Robert Steven
 * @author Lucas Perez
 * @since 25/10/16
 * @version 2
 */

//On inclus le fichier fonction.php
require_once 'include/fonction.php';
//On inclus la classe db
require_once 'modele/db.class.php';
//On inclus la classe Komidi
require_once('modele/komidi.class.php');
//On inclus la classe Mail
require_once 'modele/mail.class.php';

// Instanciation d'un objet de type Komidi.
$spectacles = new Komidi();

// Page courante
$current_page = basename($_SERVER['PHP_SELF']); // Ex: index.php

//on initilase a zero l'affichage du tableau de bord du membres
$adherent = "";

//si la variable de session id n' existe pas et est pas vide on laisse le choix de connection
if (!isset($_SESSION['id']) or empty($_SESSION['id']) ){

    $m='Connexion';
    $l= 'index.php?action=login';
}
else{
    $m = "";
    $l = "";
    ////cas ou la variable de session id existe et est remplie
    //$m='deconnexion'; $l= 'index.php?action=deconnexion';
    //$email = htmlspecialchars(htmlentities( $_SESSION['email'] ));
    $nom = htmlspecialchars(htmlentities( $_SESSION['nom'] ));
    $prenom = htmlspecialchars(htmlentities( $_SESSION['prenom'] ));
    //$mdp = htmlspecialchars(htmlentities( $_SESSION['mdp'] ));
    $idA = htmlspecialchars(htmlentities( $_SESSION['id'] ));
    $statut = htmlspecialchars(htmlentities( $_SESSION['type'] ));
    //affichage du dropdown
    $adherent =  "<div class=\"dropdown\">
  <button class=\"btn btn-success dropdown-toggle\" type=\"button\" data-toggle=\"dropdown\">$nom $prenom
  <span class=\"caret\"></span></button>
  <ul class=\"dropdown-menu\">
    <li><a href=\"index.php?action=ModifProfil&id=$idA\">Modifier Profil</a></li>
    <li><a href=\"index.php?action=SupprimerCompte&id=$idA\">Supprimer Compte</a></li>
    <li><a href=\"index.php?action=deconnexion\">Deconnexion</a></li>
  </ul>
</div>";
    //$adherent = "mail:$email;nom:$nom;prenom:$prenom;mdp:$mdp;idMembre:$idA;statut:$statut<br>";//debug
    if ( isset( $_SESSION['type'] ) and !empty( $_SESSION['type'] ) and $_SESSION['type'] == 1 ) {
        //$_SESSION['type'] == 1;
        $m2 = 'Administration';
        $l2 = 'index.php?action=admin';
    }
}



$m2 = "";
$l2 = "";
$titretab = "Komidi";
$menupage = array(
    'Accueil' => 'index.php?action=Accueil',
    /* 'Partenaire' => 'http://zeop.re', suppression du lien partnaire pour image partenaire*/
    'Contact' => 'index.php?action=Contact',
    $m =>$l ,
    $m2 =>$l2 );

//titre de la page
$titrepage = "Bienvenue sur KomidiScope !";

//emplacement du logo de la page
$logopage  = "image/logoscope.png";

//message d'acceuill
$msgaccueilpage = "Découvrez les <span  class='text-primary'><b>spectacles</b></span> <br>et les <span class='text-primary'><b>notes</b></span> d'appréciations des spectacles du festival.";


//On définie la taille des resumée.
$tailleresume = 255;

?>