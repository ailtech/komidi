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
	
	public function getSpectacle($id)
	{

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
					<a  href="#?id=<?= $id ?>">
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
