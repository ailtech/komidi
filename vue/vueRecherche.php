<?php
require 'include/config.php';
//traite les demande de recherche
    if( !isset( $_GET['texte'] ) or empty( $_GET['texte'] ) ){
        echo "O";
    }
    else{
        $texte = htmlentities(htmlspecialchars( $_GET['texte'] ));
        $rst = $spectacles->recherche($texte);

        //echo $trouver;
        //print_r($rst);

        while ( $row=$rst->fetch(PDO::FETCH_ASSOC) ){
            //$trouver = "titre:".$row['Spe_titre'].";id:".$row['Spe_id'].";lienImage".$row['Spe_affiche']."<br>";
            //echo $trouver;

            echo "<a href=\"index.php?action=getSpectacle&id=$row[Spe_id]\" class=\"list-group-item list-group-item-info\">$row[Spe_titre]</a>";    //<a href="#" class="list-group-item">First item</a>


        }

        //bbro
        // je suis ici
        //bbro
    }
?>