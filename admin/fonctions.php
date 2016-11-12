<?php

/**
 * Nettoie une valeur insérée dans une page HTML
 * Doit être utilisée à chaque insertion de données dynamique dans une page HTML
 * Permet d'éviter les problèmes d'exécution de code indésirable (XSS)
 * @param string $valeur Valeur à nettoyer
 * @return string Valeur nettoyée
 */
function escape($valeur)
{
    // Convertit les caractères spéciaux en entités HTML
    return htmlspecialchars($valeur, ENT_QUOTES, 'UTF-8', false);
}

/**
 * Gère la connexion à la base de données
 * @return PDO Objet de connexion à la BD
 */


function getCnx() {
	// Paramètres de connexion 
    $PARAM_sgbd         ="mysql";       // SGBDR
    $PARAM_hote         ="localhost";   // le chemin vers le serveur 
    $PARAM_port         ="3306";        // Port de connexion
    $PARAM_nom_bd       ="komidi";   // le nom de votre base de données
    $PARAM_utilisateur  ="root";        // nom utilisateur 
    $PARAM_mot_passe    ="";            // mot de passe utilisateur
    $PARAM_dsn          =$PARAM_sgbd.":host=".$PARAM_hote.";dbname=".$PARAM_nom_bd; // Nom de la source de données

    $dboptions = array(
    PDO::ATTR_PERSISTENT => FALSE,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",);

    $cnx = new PDO($PARAM_dsn, $PARAM_utilisateur, $PARAM_mot_passe, $dboptions);
    return $cnx;

}

function getSession() {
    // on vérifie que les variables de session identifiant l'utilisateur existent
    if (isset($_SESSION['email']) && isset($_SESSION['mdp'])) {
        $login = $_SESSION['email'];
        $mdp = $_SESSION['mdp'];
        $sessionOK = true;
    }
    return $sessionOK;
}

function getAuthentification() {
    $passh=($_POST["mdp"]);
    if (isset($_POST['email']) && isset($passh)) {
        $cnx = getCnx();
        // cette requête permet de récupérer l'utilisateur depuis la BD
        $requete = "SELECT mem_email, mem_pass,mem_id ,mem_statue FROM membres WHERE mem_email=? AND mem_pass=?";
        $resultat = $cnx->prepare($requete);
        $login = $_POST['email'];
        $mdp =   $passh;
        $resultat->execute(array($login, $mdp));
        if ($resultat->rowCount() == 1) {
            $userinfo = $resultat->fetch();
            // l'utilisateur existe dans la table
            // on ajoute ses infos en tant que variables de session
            $_SESSION['email'] = $login;
            $_SESSION['mdp'] = $mdp;
          $_SESSION['id'] =$userinfo['mem_id'];
            $_SESSION['type'] =$userinfo['mem_statue'];
            // cette variable indique que l'authentification a réussi
            $authOK = true;
        }
        return $authOK;
    }
}