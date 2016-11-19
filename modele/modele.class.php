<?php

class Spectacle
{
	private $db;
	
	function __construct($DB_cnx)
	{
		$this->db = $DB_cnx;
	}

	public function getSpectacles()
	{
		$stmt = $this->db->prepare("SELECT * FROM db_komidi ");
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	//receuille lemail
	public function getEmail($req){
		$stmt = $this->db->prepare($req);
		$stmt->execute();
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow->rowCount();
	}
	//ajoute un menbres
	public function setMembre($req){
		$stmt = $this->db->prepare($req);
		$stmt->execute();

	}
	//methode pour recuperer la vue prend en parametre l'id du spectacle
	public function getVueNote($id){

		$strSQL= "SELECT * FROM kdi_listenbNote_Moyenne WHERE Spe_id=$id;";
		$stmt = $this->db->prepare($strSQL);
		$stmt->execute();
        $edit=$stmt->fetch(PDO::FETCH_ASSOC);
        return $edit;
	}
	//recuperer les 5 meilleur spectacle
    public function get5Spectacle(){

        $strSQL= "SELECT Spe_id FROM  kdi_listenbNote_Moyenne ORDER BY moyenneNote DESC LIMIT 5;";
        $stmt = $this->db->prepare($strSQL);
        $stmt->execute();
        $edit=$stmt->fetch(PDO::FETCH_ASSOC);
        return $edit;

    }

	public function getSpectacle($id)//recupere les info lier a un spectacle
	{

		$strSQL= "SELECT Spe_id, Spe_titre, Spe_mes, Spe_genre,Spe_Lang, Spe_resume_court, Spe_affiche, Spe_public, Spe_duree, Spe_resume_long FROM kdi_spectacle WHERE Spe_id=".$id.";";
		$stmt = $this->db->prepare($strSQL);
		$stmt->execute();
		$edit=$stmt->fetch(PDO::FETCH_ASSOC);
        $note = $this->getVueNote($id);
        $noteArrondi = round($note['moyenneNote']);
		echo "<div class=\"container\">
		<!-- titre-->
		<h1>$edit[Spe_titre]</h1>
		<div class='row'>
			<div class='col-md-4'>
				<img src=\"image/$edit[Spe_affiche]\" alt='Affiche' width='197px' height='263px'><!-- image preview-->

			</div>
			<div class='col-md-8'>
				<!-- Liste -->
				<ul class='list-unstyled'>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-one-day'></span>Durée : <small>$edit[Spe_duree]  minute</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-gender-ori-hetero'></span>Genres : <small>$edit[Spe_genre]</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-family'></span>Nationalités : <small>$edit[Spe_Lang]</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-old-man'></span>Acteurs : <small>$edit[Spe_mes]</small>
						</h5>
					</li>
					<li> 
						<h5>
							<span class='glyphicons glyphicons-group'></span>Public : <small>$edit[Spe_public]</small>
						</h5>
					</li>
				</ul>
			</div>
				 
				<!-- notation -->
				<label for='input-7-xs' class='control-label'>Noter le Spectacle:</label>
				<input id='input-7-xs' class='rating rating-loading' value='$noteArrondi' data-min='0' data-max='5' data-step='1' data-size='xs'><hr/>
				$noteArrondi/5 ($note[nbDenote] votes)
				
			
			
		</div>
		<!-- texteau sujet du spectacle -->
				<H2>Synopsis</H2>
				<p class=''>
					$edit[Spe_resume_long]
				</p>
	</div>";
		return $edit;
	}
	
	
	public function updateSpectacle($params)
	{

	}
	
	public function deleteSpectacle($id)
	{

	}
	

	/* paging */
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	

		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				$id 		= $row['Spe_id'];	
				$title 		= $row['Spe_titre'];
				$genre 		= $row['Spe_genre'];
				$public 	= $row['Spe_public'];
				$tailleresume = 100;
				$synopsis 	= substr($row['Spe_resume_court'], 0, $tailleresume).' [...]';
				$picture 	= getCover($row['Spe_affiche']);
?>
				<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4"> 
					<a  href="index.php?action=getSpectacle&id=<?= $id ?>">
						<img class="img-rounded" src="<?= $picture ?>" class='img-rounded' width='150px' height='150px'>
					</a>
					<div class="caption">
						<h4><?= $title ?></h4>
						<ul class="list-unstyled">
							<li><?= $synopsis ?></li>
							<li><strong>Public :</strong><?= $public ?></li>
							<li><strong>Genre :</strong><?= $genre 	?></li>
						</ul>
					</div>
				</div>
<?php
			}
		}
		else
		{
			echo  "<div class='caption'>
				<div class='alert alert-warning'>
				<span class='glyphicon glyphicon-info-sign'></span> 
				&nbsp; Inconnu ...</div></div>";
		}
		
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>Premier</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Précédent</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Suivant</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging */
	
}

?>
