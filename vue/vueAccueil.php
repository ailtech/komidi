<?php
//on inclut le fichier de configuration.
require 'include/config.php'; 

//Titre onglet
$titretab = "Komidi Accueil";

// Menu de la page
ob_start(); 
foreach($menupage as $page_name => $page_url)
{
	$class = '';
	if ($current_page == $page_url)
	{
		$class = 'active';
	}
	echo "<li class='$class'>
		<a href='$page_url'>".$page_name ."</a>".
	 "</li>";
}
$menupage = ob_get_clean();


//Contenu de la page debut de mémoire tampon.
ob_start();
//On écrit la requête pour sélectionner les informations que l'on a besoin pour afficher les spectacles.
$strSQL= "SELECT Spe_id, Spe_titre, Spe_genre, Spe_resume_court, Spe_affiche, Spe_public FROM kdi_spectacle ORDER BY RAND()";
//On définit le nombre de spectacle que l'on veux afficher par page
$records_per_page=6;
//On éxecute la methodes paging qui va revoyer la requête de selection pour faire un affichage de 6 specatcles
$newSQL = $spectacles->paging($strSQL,$records_per_page);
//on initialise la barre de navigation des spectacles
$spectacles->paginglink($strSQL,$records_per_page);//test

echo "<div class='row affiches'>";
$spectacles->dataview($newSQL);//on fait afficher les spectacles sur la page.
echo "</div><!-- .row affiches -->";

//on initialise une autre barre de navigation des spectacles.
$spectacles->paginglink($strSQL,$records_per_page);//test
//on enregistre la mémoire tampon dans la variable $contenupage pour l'afficher dans la template.
$contenupage = ob_get_clean();

//Appel de la barre latérale
require "vue/vueSidebar.php";
//appelle de la template
require "vue/template.tpl";
 ?>