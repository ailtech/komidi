<?php      
	// Destruction de la session.

	session_start(); 
	unset($_SESSION['email']);
    unset($_SESSION['mdp']);
    unset($_SESSION['id']);
    
	if (session_destroy()) {
    	header('Location:./index.php'); 
    	echo "et" ;
		exit;
	} 
	else {
	    echo 'Erreur : impossible de détruire la session !';
	    header('Location:./index.php'); 
	}
	exit;
	     
?>