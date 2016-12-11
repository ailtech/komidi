<?php
  // démarrage d'une session
$authOK = getAuthentification();
//echo $authOK;//debug
if( $authOK && $_SESSION['type'] == 0 ){
    //on redirige vers l'acceuil c'est un utilistaeur
    //echo "c'est un utilisateur";//debug
    header('Location: index.php');
}
else if( $authOK && $_SESSION['type'] == 1 ){
    //on redirige vers la page admin
    //echo "On vas vers l'admin";
    header('Location:vue/admin/index.php?action=admin');
}
else{
    //la personne n'existe pas
    header('Location: index.php');
}


?>

