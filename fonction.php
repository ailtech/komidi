<?php

function debug($tableau) {
	echo '<pre>'.print_r($tableau, true).'</pre>';
}

function getCover($spec_id = 0) {
	$picture = 'image/'.$spec_id;
	if (file_exists($picture)) {
		return $picture;
	}
	return 'image/defaut.png';
}

function redirectJS($url, $delay = 1) {
	echo '<script>
		  setTimeout(function() {
		  		location.href = "'.$url.'"; }
		  , '.($delay * 1000).');
		  </script>';
}

/*
function displayList($title, $items, $class = 'default') {

	$html = '<div class="panel panel-'.$class.'">
		<div class="panel-heading">'.$title.'</div>
		<div class="list-group">';

		foreach($items as $key => $item) {
				$title = $item['title'];
			$html .= '<a href="movie.php?id='.$item['id'].'" class="list-group-item">'.$title.'</a>';
		}

	$html .= '</div>
	</div>';

	return $html;
}
*/


function displayList($title, $items, $class = 'default', $url = 'movie.php') {

	static $allowed_classes = array('default', 'info', 'primary', 'warning', 'danger', 'success');
	if (!in_array($class, $allowed_classes)) {
		$class = 'default';
	}

	include 'partials/list-panel.php';
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
//steven
function deconnexion() {
    // Destruction de la session.

    session_start();
    unset($_SESSION['email']);
    unset($_SESSION['mdp']);
    unset($_SESSION['id']);

    if (session_destroy()) {
        header('Location:vue/index.php');
        echo "et" ;
        exit;
    }
    else {
        echo 'Erreur : impossible de détruire la session !';
        header('Location:./index.php');
    }
    exit;


}

/**
 *
 */
function    Accueil() {
    header("Location:../../../index.php");
}
function getAuthentification() {
    $passh=md5($_POST["mdp"]);
    if (isset($_POST['email']) && isset($passh)) {
        $cnx = getCnx();
        // cette requête permet de récupérer l'utilisateur depuis la BD
        $requete = "SELECT * FROM membres WHERE mem_email=? AND mem_pass=?";
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
function getCnx() {
    // Paramètres de connexion
    $PARAM_sgbd         ="mysql";       // SGBDR
    $PARAM_hote         ="localhost";   // le chemin vers le serveur
    $PARAM_port         ="3306";        // Port de connexion
    $PARAM_nom_bd       ="db_komidi";   // le nom de votre base de données
    $PARAM_utilisateur  ="root";        // nom utilisateur
    $PARAM_mot_passe    ="root";            // mot de passe utilisateur
    $PARAM_dsn          =$PARAM_sgbd.":host=".$PARAM_hote.";dbname=".$PARAM_nom_bd; // Nom de la source de données

    $dboptions = array(
        PDO::ATTR_PERSISTENT => FALSE,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",);

    $cnx = new PDO($PARAM_dsn, $PARAM_utilisateur, $PARAM_mot_passe, $dboptions);
    return $cnx;

}
