<?php
/**
 * Ce fichier permet de deconnecter le personne.
 * @copyright ailtech
 * @author Lefevre Alexandre
 * @author Robert Steven
 * @since 1
 * @version 1
 *
 */
    //On inclut le fichier de configuration
    require 'include/config.php';
//On detruit la session
    session_destroy();
//on remet le bouton pour se conncter en place
    $m='Connexion';
    $l= 'index.php?action=login';

    $titre = "Connexion utilisateur";
    $titrecontenu   = "<h2>Connexion </h2>";
    ob_start();
    foreach($menupage as $page_name => $page_url)
    {
        $class = '';
        if ($current_page == $page_url) {
            $class = 'active';
        }
        echo "<li class='$class'>
        <a href='$page_url'>".$page_name ."</a>".
            "</li>";
    }
    $menupage = ob_get_clean();

    ob_start();
    echo "<p>vous ete desormais deconecter</p>";

    $contenupage = ob_get_clean();

    require "vue/vueSidebar.php";
    require 'template2.tpl';



?>