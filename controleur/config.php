<?php

require_once 'include/fonction.php';






// Paramètres de connexion
    $PARAM_sgbd         = "mysql";      // SGBDR
    $PARAM_hote         = "localhost";  // le chemin vers le serveur
    $PARAM_port         = "3306";       // Port de connexion
    $PARAM_nom_bd       = "db_komidi";	// le nom de votre base de données
    $PARAM_utilisateur  = "root";       // nom utilisateur
    $PARAM_mot_passe    = "root";     // mot de passe utilisateur
    // Nom de la source de données
    $PARAM_dsn          = $PARAM_sgbd.":host=".$PARAM_hote.";dbname=".$PARAM_nom_bd; 

    $dboptions = array(
        PDO::ATTR_PERSISTENT => FALSE,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",);

    try{
        $DB_cnx = new PDO($PARAM_dsn, $PARAM_utilisateur, $PARAM_mot_passe, $dboptions);
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }
    
    require_once('modele/modele.class.php');

    $spectacles = new Komidi($DB_cnx);

// Page courante
    $current_page = basename($_SERVER['PHP_SELF']); // Ex: index.php

// Paramètrage de la page
;
 if (!isset($_SESSION['id'])){
        
    $m='Connexion';
    $l= 'index.php?action=login';
    }

     if (!empty($_SESSION['id'])){
       $m='deconnexion'; $l="index.php?action=deconnexion";

         if (!empty($_SESSION['type'])) {
             $_SESSION['type'] == 1;
             $m2 = 'Administration';
             $l2 = "index.php?action=admin";
         }
     }     

    $titretab = "Komidi";
    $menupage = array(
        'Accueil' => 'index.php?action=Accueil',
        'Rechercher' => '#Rechercher',
       'Partenaire' => 'http://zeop.re',
        $m =>$l ,
        $m2 =>$l2
        );

    $titrepage = "Bienvenue sur KomidiScope !";
    $logopage  = "image/logoscope.png";

    $msgaccueilpage = "Découvrez notre <a href='search.php'>
                recherche</a> de spéctacle et les 
                <a href='news.php'>actualités</a> du festival.";
                
    $msgaccueilpage = "";

    $tailleresume = 255;
?>