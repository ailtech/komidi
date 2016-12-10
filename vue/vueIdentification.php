<?php
  // démarrage d'une session
$authOK = getAuthentification();
if (!$authOK or $_SESSION['type']== 0) {
  
    header('Location: index.php');
}
else {
    $sessionOK = getSession();

}

if ($sessionOK) {
    header('Location:index.php?action=admin');
        }
  else {
            header('Location: index.php');
        }

?>

