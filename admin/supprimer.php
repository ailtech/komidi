<?php
 
    include 'templates/header.php';

    $idp = $_GET['idp'];
 
    $strSQL= "DELETE FROM tbl_produits WHERE id ='".$idp ."';";
    $result_supp = $cnx->query($strSQL);

    header('Location: ./administration.php');    

?>