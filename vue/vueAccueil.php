<?php 
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
$strSQL= "SELECT Spe_id, Spe_titre, Spe_genre, Spe_resume_court, Spe_affiche, Spe_public FROM kdi_spectacle ORDER BY RAND()";
      
$records_per_page=6;
$newSQL = $spectacles->paging($strSQL,$records_per_page);
$spectacles->dataview($strSQL);
echo "</div><!-- .row affiches -->";
$contenupage = ob_get_clean();

//Appel de template
require "vue/vueSidebar.php";
require "vue/template.tpl";
 ?>