<?php
require('include/config.php');
//on regarde si lid est bien la
 if( isset( $_GET['id'] ) && !empty( $_GET['id'] ) ){
     $id = htmlspecialchars(htmlentities( $_GET['id'] ));
     // onsupprime le spectacle
     $spectacles->deleteSpectacle($id);
     //on affiche le message de suppression
     echo "<div class=\"alert alert-success\">
  <strong>Attention</strong> Le spectacle vien d'être supprimer.
</div>";
 }
 else{
     //si erreur on affiche ce message
     echo "<div class=\"alert alert-danger\">
  <strong class=\"alert alert-success\">Attention</strong> Le spectacle vien d'être supprimer.
</div>";
 }
?>

