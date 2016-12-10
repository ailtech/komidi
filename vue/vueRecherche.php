<?php
require 'include/config.php';
//traite les demande de recherche
    if( !isset( $_GET['texte'] ) or empty( $_GET['texte'] ) ){
        echo "O";
    }
    else{
        $texte = htmlentities(htmlspecialchars( $_GET['texte'] ));
        $rst = $spectacles->recherche($texte);
        $trouver = "titre:".$rst['Spe_titre'].";id:".$rst['Spe_id'].";lienImage".$rst['Spe_affiche'];
        //echo $trouver;
        //print_r($rst);
        foreach ($rst as $i => $value) {
            print_r($value);
        }
        //bbro
        // je suis ici
        //bbro
    }
?>