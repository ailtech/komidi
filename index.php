<?php


session_start();

require('./controleur/Controleur.php');
//echo $_GET['action'] ;
//exit;
try {
	if (isset($_GET['action'])  and !empty($_GET['action']))
	{
		if ($_GET['action'] == 'Accueil') {
			accueil() ; // Acceuil du site
			exit;
		}
		if ($_GET['action'] == 'login') {
			login();  // connexion
			exit;
		}
		if ($_GET['action'] == 'demandeInscription') {
			demandeInscription() ; // Acceuil du site
			exit;
		}
		if ($_GET['action'] == 'inscription') {
			inscription();  // connexion
			exit;
		}
		if ($_GET['action'] == 'connec') {
			connec() ; // Acceuil du site
			exit;
		}
		if ($_GET['action'] == 'Contact') {
			contact();  // page de contact
			exit;
		}
		if ($_GET['action'] == 'noter') {
			noter();  // page de notation
			exit;
		}
		if ($_GET['action'] == 'getSpectacle') {
			spectacle(); // Acceuil du site
			exit;
		}
		if (isset($_GET['action'] )) {
			if(!empty($_GET['action'] )) {
				erreur() ; // Acceuil du site
				exit;
			}
		}
	}
	else {

		accueil();
	}


}
catch (Exception $e) {
	erreur($e->getMessage());
}
?>
