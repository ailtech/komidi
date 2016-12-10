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
    $idMembre = "";
    $id = htmlentities(htmlspecialchars( $_GET['id'] ));
    $spectacle = $spectacles->getSpectacle($id);
    $note = $spectacles->getVueNote($id);
    $noteArrondi = round($note['moyenneNote']);
    //partit pour un membres connecter
    if( isset( $_SESSION['id'] ) and empty( $_SESSION['id'] ) ){
        $idMembre = $_SESSION['id'];
        echo "<div class=\"container\">
		<!-- titre-->
		<div class=\"alert alert-success\" role=\"alert\" id='alertNotation' style='display:none;'></div>
		<h1>$spectacle[Spe_titre]</h1>
		<div class='row'>
			<div class='col-md-4'>
				<img src=\"image/$spectacle[Spe_affiche]\" alt='Affiche' width='197px' height='263px'><!-- image preview-->

			</div>
			<div class='col-md-8'>
				<!-- Liste -->
				<ul class='list-unstyled'>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-one-day'></span>Durée : <small>$spectacle[Spe_duree]  minute</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-gender-ori-hetero'></span>Genres : <small>$spectacle[Spe_genre]</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-family'></span>Nationalités : <small>$spectacle[Spe_Lang]</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-old-man'></span>Acteurs : <small>$spectacle[Spe_mes]</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-group'></span>Public : <small>$spectacle[Spe_public]</small>
						</h5>
					</li>
				</ul>
			</div>
				 
				<!-- notation -->
				<form action='#' method='POST'>
				<label for='input-7-xs' class='control-label'>Noter le Spectacle:</label>
				<input id='input-7-xs' class='rating rating-loading' value='$noteArrondi' data-min='0' data-max='5' data-step='1' data-size='xs' ><hr/>
				$noteArrondi/5 ($note[nbDenote] votes)
				
					<input type='hidden' name='idSpectacle' value='$spectacle[Spe_id]'>
					
					<input type='hidden' name='idMembre' value='$idMembre'>
					<input type='submit' value='Voter' id='note'>
					
				</form>
				
				
			
			
		</div>
		<!-- texteau sujet du spectacle -->
				<H2>Synopsis</H2>
				<p class=''>
					$spectacle[Spe_resume_long]
				</p>
	</div>";
    }
    else{
        //partit pour une personne non conecter
        echo "<div class=\"container\">
		<!-- titre-->
		<div class=\"alert alert-success\" role=\"alert\" id='alertNotation' style='display:none;'></div>
		<h1>$spectacle[Spe_titre]</h1>
		<div class='row'>
			<div class='col-md-4'>
				<img src=\"image/$spectacle[Spe_affiche]\" alt='Affiche' width='197px' height='263px'><!-- image preview-->

			</div>
			<div class='col-md-8'>
				<!-- Liste -->
				<ul class='list-unstyled'>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-one-day'></span>Durée : <small>$spectacle[Spe_duree]  minute</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-gender-ori-hetero'></span>Genres : <small>$spectacle[Spe_genre]</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-family'></span>Nationalités : <small>$spectacle[Spe_Lang]</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-old-man'></span>Acteurs : <small>$spectacle[Spe_mes]</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-group'></span>Public : <small>$spectacle[Spe_public]</small>
						</h5>
					</li>
				</ul>
			</div>
				 
				<!-- notation -->
				<form action='#' method='POST'>
				<label for='input-7-xs' class='control-label'>Noter le Spectacle:</label>
				<input id='input-7-xs' class='rating rating-loading' value='$noteArrondi' data-min='0' data-max='5' data-step='1' data-size='xs' readonly><hr/>
				$noteArrondi/5 ($note[nbDenote] votes)
				
					<input type='hidden' name='idSpectacle' value='$spectacle[Spe_id]'>
					
					<input type='hidden' name='idMembre' value='$idMembre'>
					<!-- <input type='submit' value='Voter' id='note'> -->
					
				</form>
				
				
			
			
		</div>
		<!-- texteau sujet du spectacle -->
				<H2>Synopsis</H2>
				<p class=''>
					$spectacle[Spe_resume_long]
				</p>
	</div>";
    }


}


echo "</div><!-- .row affiches -->";
$contenupage = ob_get_clean();

//Appel de template
require "vue/vueSidebar.php";
require "vue/template2.tpl";
?>