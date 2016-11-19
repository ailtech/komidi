<?php
//require 'include/config.php';
// Sidebar 5 mieux notés

//echo sizeof($spe);
ob_start();
?>
<div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
	<div class="panel panel-success">
		<div class="panel-heading">Les 5 spectacles les mieux notés</div>
		<div class="list-group">
			<?php
			/*
				$i = 0;
			$spe = $spectacles->get5Spectacle();
			foreach ($spe as $s){
				echo $s[$i];
				$id = $s["Spe_id"];
				$titre = $s["Spe_titre"];
				//echo "tour $i";
				echo "<a href=\"index.php?action=getSpectacle&id=$id\" class=\"list-group-item\">$titre</a>";
				$i= $i+1;
			}


			*/
			?>

			<a href="#?id=1" class="list-group-item">Spectacle1</a>
			<a href="#?id=2" class="list-group-item">Spectacle2</a>
			<a href="#?id=3" class="list-group-item">Spectacle3</a>
			<a href="#?id=4" class="list-group-item">Spectacle4</a>
			<a href="#?id=5" class="list-group-item">Spectacle5</a>

		</div>
	</div>
</div>
<?php
$sidebarpage = ob_get_clean();
?>