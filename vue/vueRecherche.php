<?php
/**
 * Ce fichier permet de réaliser une recherche dans la base de donnée,
 * il est exécutée et lu de façon asynchronyme par le fichier se trouvant dans /bootstrap/js/recherche.js
 *La page affiche le résultat de la recherche sous forme html qui sera ensuite lu et intégrer au dom asynchronymement
 * @copyright ailtech
 * @author Lefevre Alexandre
 * @since 1
 * @since 2 Affichage des spectacles dans la bar de recherche retravailer
 * @version 2
 */

//On inclut le fichier de configuration
require 'include/config.php';

    //On vérifie que l'utilisateur a bien envoyer le texte a rechercher
    if( !isset( $_GET['texte'] ) or empty( $_GET['texte'] ) )// cas ou le texte a rechercher n'existe pas ou est vide
    {
        echo "O";// on affiche 0 qui indique que l'action est impossible, cette valeur sera traiter par le fichier /bootstrap/js/recherche.js
    }
    else//cas ou le texte à recherchée est présent et non vide.
    {
        //On extrait est échape le texte
        $texteRechercher = htmlentities(htmlspecialchars( $_GET['texte'] ));

        //On utilise la méthode recherche de l'objet Komidi pour récupérer tout les eléments que la requête retourne.
        $resultatRequete = $spectacles->recherche($texteRechercher);

        //on parcours le résultat de la requête et on affiche les éléments renvoyer en les formattant.
        while ( $row = $resultatRequete->fetch(PDO::FETCH_ASSOC) )
        {

            echo "<div class=\"media\">
									<div class=\"media-left\">
										<img src=\"image/$row[Spe_affiche]\" class=\"media-object\" style=\"width:60px;height:60px\">
									</div>
									<div class=\"media-body\">
										<h4 class=\"media-heading\"><a href=\"index.php?action=getSpectacle&id=$row[Spe_id]\">$row[Spe_titre]</a></h4>
										<p>$row[Spe_genre]</p>
									</div>
								</div>";
        }

    }
?>