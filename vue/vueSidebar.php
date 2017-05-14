<?php
/**
 * Ce fichier permet d'afficher la barre latérale des 5 spectacles les mieux notées.
 * @copyright ailtech
 * @author Lefevre Alexandre
 * @since 1
 * @version 1
 */

//On récupéres la liste des 5 spectacles les mieux notées.
$top5meilleurSpectacle = $spectacles->get5Spectacle();

//debut de mémoire tampon
ob_start();
?>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	<div class="panel panel-success">
		<div class="panel-heading">Les 5 spectacles les mieux notés</div>
		<div class="list-group">
			<?php
				//On extrait le résultat retourner et affichons les 5 meilleurs spectacles.
				while($row=$top5meilleurSpectacle->fetch(PDO::FETCH_ASSOC))
				{
					$nom = $row["Spe_titre"];
					$id = $row["Spe_id"];
					echo "<a href=\"index.php?action=getSpectacle&id=$id\" class=\"list-group-item\">$nom</a>";
				}
			?>

		</div>
	</div>
</div>
<?php
//Fin mémoire tampon on enregistre le mémoire tampon dans la variable $sidebarpage pour znsuitez l'afficher dans la template
$sidebarpage = ob_get_clean();
?>