<?php
/**
 * Ce fichier permet de noter un spectacle,
 * ce fichier est executée et lu de façon asynchronyme par le fichier se trouvant dans /bootstrap/js/noter.js.
 * C'est pour sa que nous fesont afficher du texte avec des echo pour ensuite traiter plus facilement la réponse dans le fichier javascript
 * se trouvant dans /bootstrap/js/noter.js
 * @copyright ailtech
 * @author Lefevre Alexandre
 * @since 1
 * @version 1
 */

//on inclue le fichier de configuration
require 'include/config.php';


//on vérifie si on a bien envoyer l'identifiant du membres, du spectacle et le nombre d'étoile donnée au spectacle.A noter qu'on utilise la negation pour vérifier
    if( !isset( $_GET['idMembres'] ) or empty( $_GET['idMembres'] ) or !isset( $_GET['idSpectacle'] ) or empty( $_GET['idSpectacle'] ) or !isset( $_GET['nbEtoile'] ) or empty( $_GET['nbEtoile'] ) or $_GET['nbEtoile'] > 5 or $_GET['nbEtoile'] < 0)
    {
        echo "false";// si une des information et manquante ont affiche false
    }
    else// cas ou il existe tous
    {
        //On extrait les donnéee et échappe les caractéres spéciaux.
        $idMembre = htmlspecialchars(htmlentities( $_GET['idMembres'] ));
        $idSpectacle = htmlspecialchars(htmlentities( $_GET['idSpectacle'] ));
        $nbEtoile = htmlspecialchars(htmlentities( $_GET['nbEtoile'] ));

        //On la methode noter de l'objet Komidi qui retourne soit 1 pour réeussi et 0 pour non réussie
        $veriter = $spectacles->noter($idMembre,$idSpectacle,$nbEtoile);
        //on affiche le résultat
        echo $veriter;//  si réussi
    }




?>