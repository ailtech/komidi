<?php
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
//Formulaire pour ajouter un membres
if( !isset($_REQUEST["nom"] or empty($_REQUEST["nom"]) ) ){//verifier le nom
	//cas ou le nom n'existe pas ou est vide
	//**********RETOURNER UNE ERREUR**************
}
else{

	if( !isset($_REQUEST["prenom"]) or empty($_REQUEST["prenom"]) ){
		//cas ou le prenom n'existe pas ou est vide
		//**********RETOURNER UNE ERREUR**************
	}
	else{

		if( !isset($_REQUEST["email"]) or empty($_REQUEST["email"]) ){//verifier l'email
			//cas ou l'email n'existe pas ou est vide
			//**********RETOURNER UNE ERREUR**************
		}
		else{
			$verifEmail = var_dump(filter_var($_REQUEST["email"],FILTER_VALIDATE_EMAIL);
			if( $verifEmail == False ) ){ //verifier l'email avec un regex
				//**********RETOURNER UNE ERREUR**************


			}
			else{
				$req = "SELECT mem_email FROM menbres WHERE mem_email=$_REQUEST['email'];"; //adapter requete a bdd
 				$verifEmailExistant = $spectacles->getEmail($req);
				if( $verifEmailExistant > 0){//verifier si l'email n'est pas deja enregistrer dans la base donnée
					//**********RETOURNER UNE ERREUR**************
					//CREER LA METHODE QUI VERIFIE SI L'EMAIL N'EST PAS DEJA EXISTANTE
				}
				else{

					if( !isset($_REQUEST["sex"] or empty($_REQUEST["sex"]) ) ){//verifier le sex
						//cas ou le sex n'existe pas ou est vide
						//**********RETOURNER UNE ERREUR**************
					}
					else{
						$nom = htmlspecialchars( $_REQUEST["nom"] );
						$prenom = htmlspecialchars( $_REQUEST["prenom"];
						$email = htmlspecialchars( $_REQUEST["email"];
						$sex = htmlspecialchars( $_REQUEST["sex"];
						$mdp = md5( htmlspecialchars( $_REQUEST["sex"]) );
						$date = ; //date a voir
						$req = "INSERT INTO menbres VALUES('',$email,$mdp,$nom,$prenom,0,$dateInscrip,$sex)";//adapter la base de donner
						$spectacles->setMembre($req);
						//crerr methode d'ajout d'un membre dans la class spectacle envoyer en parametre les info
						//echaper les variable reçus
					}

				}
			}

			
		}

	}
}

$contenupage = ob_get_clean();


//Appel de template
require "vue/vueSidebar.php";
require "vue/template.tpl";
?>