<?php
/**
 * Ce fichier permet d'afficher les informations sur spectacle précis,
 * et permet la notation si cette personne est connecter sinon elle ne le permet pas.
 * @copyright ailtech
 * @author Lefevre Alexandre
 * @since 1 Premiéres version
 * @since 2 Affichage des spectacles retravailer
 * @version 2
 */

//On inclue le fichier de configuration
require 'include/config.php';


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

//on verifie si un l'identifiant de spectacle a bien étè envoyer.
if( !isset( $_GET['id'] ) or empty( $_GET['id'] ) )
{
    //erreur l'id na pas etait envoyer
}
else
{
    //On met l'identifiant du membres zero, c'est en quelque sort un netoyage de la variable
    $idMembre = "";

    //on extraite et echape l'identifiant du spectacle
    $id = htmlentities(htmlspecialchars( $_GET['id'] ));

    //On récupere les informations sur le spectacle
    $spectacle = $spectacles->getSpectacle($id);

    //On récupéres la note moyenne du spectacle
    $note = $spectacles->getVueNote($id);
    $noteArrondi = round($note['moyenneNote']);

    //partit pour un membres connecter
    if( isset( $_SESSION['id'] ) and !empty( $_SESSION['id'] ) )
    {
        //idMembre possede l'identifiant de l'utilisateur actuellement connecter
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
        echo "<div id='map'></div>";
    }
    else//cas ou c'est une personne non connecter
    {
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
        echo "<div id='map'></div>";
    }



}


echo "</div><!-- .row affiches -->";
$contenupage = ob_get_clean();

//Appel de template et barre de navigation latérale
require "vue/vueSidebar.php";
require "vue/template2.tpl";
?>