<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 13/11/16
 * Time: 13:37
 */
require 'include/config.php';

//include './modele/modele.class.php';

//$spectacles = new Spectacle($DB_cnx);

//Titre onglet
$titretab = "Komidi Accueil";
// Menu de la page
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

//Contenu de la page
ob_start();
echo "<div class='row affiches'>";

if( !isset( $_GET['id'] ) or empty( $_GET['id'] ) ){
    //erreur l'id na pas etait envoyer
}
else{
    $id = htmlentities(htmlspecialchars( $_GET['id'] ));
    $spectacle = $spectacles->getSpectacle($id);
    //creer une methode pour afficher un spectacle ou afficher directement dans la vue ici

}

echo "</div><!-- .row affiches -->";
$contenupage = ob_get_clean();

//Appel de template
require "vue/vueSidebar.php";
require "vue/template.tpl";
?>