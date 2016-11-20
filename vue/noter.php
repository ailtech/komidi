<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 20/11/16
 * Time: 09:51
 *
 */
require 'include/config.php';

    if( !isset( $_GET['idMembres'] ) or empty( $_GET['idMembres'] ) or !isset( $_GET['idSpectacle'] ) or empty( $_GET['idSpectacle'] ) or !isset( $_GET['nbEtoile'] ) or empty( $_GET['nbEtoile'] ) or $_GET['nbEtoile'] > 5 or $_GET['nbEtoile'] < 0){
        echo "false";// si échec
    }
    else{
        $idMembre = htmlspecialchars(htmlentities( $_GET['idMembres'] ));
        $idSpectacle = htmlspecialchars(htmlentities( $_GET['idSpectacle'] ));
        $nbEtoile = htmlspecialchars(htmlentities( $_GET['nbEtoile'] ));
        //echo $idMembre.'.'.$idSpectacle.'.'.$nbEtoile;//debug
        echo $spectacles->noter($idMembre,$idSpectacle,$nbEtoile);//  si réussi
    }
?>