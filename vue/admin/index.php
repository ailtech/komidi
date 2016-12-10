<?php
// Dispatcher
session_start();

  // démarrage d'une session

if ($_SESSION['type']==1) {


    require('controleur/Controleur.php');
    require('include/config.php');



    include 'templates/header.php';

    if (isset($_GET['action'])) {
        // Page d'accueil
        if ($_GET['action'] == 'admin') {
            admin();
            exit;
        }
        if ($_GET['action'] == 'accueil') {
            Accueil() ; // Acceuil du site
            exit;
        }
        //Ajouter
        if ($_GET['action'] == 'ajout') {
         echo 1;
            ajout();

            exit;

        }

        //Supprimer
        if ($_GET['action'] == 'delete') {
            exit;
        }

        //Modifier
        if ($_GET['action'] == 'update') {
            exit;
        }
        // Destruction de la session.
        if ($_GET['action'] =='deconnexion') {
            deconnexion(); //  du site
            exit();
        }
    } else {
        // action par défaut
        admin();
    }
    include 'templates/footer.php';
}


 else {
    header('Location: index.php');
}


?>