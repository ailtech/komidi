<?php
	$titre = "KOMIDI: Erreur";
	ob_start();
?>
	<h1 class="error-404">
		<span>404</span>
	</h1>
   <br><br>
   <h2 class="title">Page non trouvée</h2>
	<p class="message">
		La page que vous avez demandée  n'existe pas encore ou est en maintenance .
		<br />

		<a href="index.php?action=Accueil">Retour a accueil </a></p>


<?php 
	$contenupage = ob_get_clean();

    require "vue/vueSidebar.php";
    require 'template.tpl';

?>