<?php
  // démarrage d'une session
$authOK = getAuthentification();
//echo $authOK;//debug

if (!$authOK or $_SESSION['type']== 0) {
    //echo "c'est un utilisateur";//debug
    header('Location: index.php');
}
else {
    $sessionOK = getSession();
    //echo "On est entrai utiliser la fonction sessionOK";//debug

}

if ($sessionOK) {
    //echo "On est entrain de rediriger vers l'admin";//debug
    header('Location:index.php?action=admin');
        }
  else {
            header('Location: index.php');
      //echo "On est entrain de rediriger vers l'acceuil par default";//debug
        }

?>

