<?php
session_start();  // démarrage d'une session

include "fonctions.php";


$authOK = getAuthentification();

if (!$authOK )  {
	header('Location: index.php');  
}
else {
	 $sessionOK = getSession();
}

if ($sessionOK) {

	include 'templates/header.php';

	?>

	<div class="container">
	<h2> KOMIDI Administration</h2>

	<table class="table table-striped">
	    <thead>                
	        <tr>
	            <th>id</th>
	            <th>Nom spectacle</th>
	            <th>les acteurs</th>
	            <th>affiche</th>
	             <th>resumer spectacle</th>
	            
	            
	        </tr>
	    </thead>
    
	<?php
	$reponse = $cnx->query("SELECT * FROM  kdi_spectacle ORDER BY Spe_id;");
	while($donnees=$reponse->fetch())
	{
	    ?>
	    <tbody>
	      <tr>
	        <td><?php echo $donnees['Spe_id']; ?></td>
	        <td><?php echo $donnees['Spe_titre']; ?></td>
	        <td><?php echo $donnees['Spe_acteur']; ?></td>
	        <td><?php echo $donnees['Spe_affiche']; ?></td>
	        <td><?php echo $donnees['Spe_resume_court']; ?></td>
	      

	       <td>
	            <!-- 
	            	<a href="supprimer.php" class="btn btn-xs btn-danger" title="Supprimer"><span class="glyphicon glyphicon-remove"></span></a>
	            -->
	            
	            <a class="btn btn-xs btn-danger" title="Supprimer" href="#?idp=<?= $donnees['Spe_id'];  ?>">
	            	<span class="glyphicon glyphicon-remove"></span>
	            </a>
	            <a title="Modifier" href="#" class="btn btn-xs btn-danger" ><span class="glyphicon glyphicon-pencil"></span></a
	      </tr>
	  
<?php
	}
	if(isset($_GET['idp'])){
		$idp = $_GET['idp'];
		$strSQL= "DELETE FROM kdi_spectacle WHERE id ='".$idp ."';";
		echo $strSQL;
		exit;

	}
	include 'templates/footer.php';
}
else {
	header('Location: index.php');
}
?>

