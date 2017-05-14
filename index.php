<?php
/**
 * Ce fichier est le dispatcheur
 * Le dispatcheur permet de faire afffichée des pages ou de réaliser des actions, que l'utilisateur demande.Il écoute les instructions avec
 * la super global $_GET['action'].
 * @copyright ailtech
 * @author Alexandre
 * @author Robert
 * @since 25/10/16
 * @version 2
 */

//on démarre la session
session_start();

//on importe la class Controleur
require('./controleur/Controleur.class.php');

//On importe le fichier contenant les fonctions
require('./include/fonction.php');
//On instancie un objet Contoleur avec le path
$controleur = new Controleur("./vue/");

//On capture les exception
try
{
	//On regarde si la variable action existe et n'est pas vide
	if (isset($_GET['action'])  and !empty($_GET['action']))
	{
		// On regarde si la variable action contient la valeur requise.
		if ($_GET['action'] == 'Accueil')
		{
			$controleur->call_accueil(); // Acceuil du site
			//On sort du programme
			exit;
		}
		if ($_GET['action'] == 'recherche')
		{
			$controleur->call_recherche() ; // recherche du site
			exit;
		}
		if ($_GET['action'] == 'login')
		{
			$controleur->call_login();  // connexion
			exit;
		}
		if ($_GET['action'] == 'demandeInscription')
		{
			$controleur->call_demandeInscription() ; // Acceuil du site
			exit;
		}
		if ($_GET['action'] == 'deconnexion')
		{
			$controleur->call_deco();  // deconection
			exit;
		}
		if ($_GET['action'] == 'inscription')
		{
			$controleur->call_inscription();  // connexion
			exit;
		}

		if ($_GET['action'] == 'connexion')
		{
			$controleur->call_connexion();  // page de contact
			exit;
		}
		if ($_GET['action'] == 'Contact')
		{
			$controleur->call_contact();  // page de contact
			exit;
		}
		if ($_GET['action'] == 'demandeContact')
		{
			$controleur->call_demande_contact();  // page de contact
			exit;
		}
		if ($_GET['action'] == 'noter')
		{
			$controleur->call_noter();  // page de notation
			exit;
		}

		if ($_GET['action'] == 'getSpectacle')
		{
			$controleur->call_spectacle(); // Acceuil du site
			exit;
		}
		if (isset($_GET['action'] ))
		{
			if(!empty($_GET['action'] ))
			{
				$controleur->call_erreur() ; // Acceuil du site
				exit;
			}
		}
	}
	else// cas ou action non existante on renvoie vers l'acceuil
	{

		$controleur->call_accueil();
	}


}
catch (Exception $e)
{
	//on affiche l'exception capturée.
	erreur($e->getMessage());
}
?>
