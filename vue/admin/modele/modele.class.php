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

        $strSQL= "SELECT S.Spe_titre,S.Spe_id
FROM kdi_spectacle S,cinqBestSpectacle B
WHERE S.Spe_id = B.Spe_id;";
        $stmt = $this->db->prepare($strSQL);
        $stmt->execute();
        $edit=$stmt->fetch(PDO::FETCH_ASSOC);
        return $edit;
		//return $stmt->fetch(PDO::FETCH_ASSOC);

    }
    //verifie si le membres existe
	public function verifMembre($idMembre){
		$strSQL= "SELECT mem_id FROM membres WHERE mem_id = $idMembre;";
		$stmt = $this->db->prepare($strSQL);
		$stmt->execute();
		//$edit=$stmt->fetch(PDO::FETCH_ASSOC);
		return $stmt->rowCount();
	}
	//verifie si un spectacle existe
	public function verifSpectacle($idSpectacle){
		$strSQL= "SELECT Spe_id FROM kdi_spectacle WHERE Spe_id = $idSpectacle;";
		$stmt = $this->db->prepare($strSQL);
		$stmt->execute();
		//$edit=$stmt->fetch(PDO::FETCH_ASSOC);
		return $stmt->rowCount();
	}
    //verifie si la personne a déja voter
	public function verifNoter($idMembre,$idSpectacle){
		//faire envoyer la variable id membres de sessio aussi pour verifier si la personne ne tente ppas une usurpation d' id membres
		$strSQL= "SELECT mem_id,Spe_id FROM noter WHERE mem_id =$idMembre  AND Spe_id = $idSpectacle;";
		$stmt = $this->db->prepare($strSQL);
		$stmt->execute();
		//$edit=$stmt->fetch(PDO::FETCH_ASSOC);
		return $stmt->rowCount();
	}
	//enregistre le vote de la personne
    public function noter($idMembre,$idSpectacle,$note){
		//echo $this->verifNoter($idMembre,$idSpectacle).";".$this->verifMembre($idMembre).";".$this->verifSpectacle($idSpectacle);

		if( $this->verifNoter($idMembre,$idSpectacle) == 1 or $this->verifMembre($idMembre) == 0 or $this->verifSpectacle($idSpectacle) == 0){
			return "0";
		}
		else{
			$strSQL= "INSERT INTO noter VALUES($idMembre,$idSpectacle,$note);";
			$stmt = $this->db->prepare($strSQL);
			$stmt->execute();
			return "1";
		}


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
		<div class=\"alert alert-success\" role=\"alert\" id='alertNotation' style='display:none;'></div>
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
				<form action='#' method='POST'>
				<label for='input-7-xs' class='control-label'>Noter le Spectacle:</label>
				<input id='input-7-xs' class='rating rating-loading' value='$noteArrondi' data-min='0' data-max='5' data-step='1' data-size='xs'><hr/>
				$noteArrondi/5 ($note[nbDenote] votes)
				
					<input type='hidden' name='idSpectacle' value='$id'>
					
					<input type='hidden' name='idMembre' value='3'>
					<input type='submit' value='Voter' id='note'>
					
				</form>
				
				
			
			
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

class Database
{
	private $pdo = null;

	public function __construct()
	{
		$this->db_sgbd = "mysql";
		$this->db_name = "db_komidi";
		$this->db_user = "root";
		$this->db_pass = "";
		$this->db_host = "localhost";
		$this->db_port = 3306;

	}

	// Connexion à la BDD
	private function getPDO()
	{
		if ($this->pdo === null) {

			try {
				// DSN
				$pdo = new PDO($this->db_sgbd . ":dbname=" . $this->db_name . ";
                                host=" . $this->db_host . ";
                                port=". $this->db_port, $this->db_user, $this->db_pass);


				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$pdo->exec("SET CHARACTER SET utf8");

				$this->pdo = $pdo;

			} catch (PDOException $e) {
				echo 'Erreur lors de la connexion à la BDD : ' . $e->getMessage();
				die();
			}

		}

		return $this->pdo;
	}

	// Requête simple
	public function requete($parametre)
	{
		$strSQL  = $this->getPDO()->query($parametre);
		$data = $strSQL->fetchAll(PDO::FETCH_ASSOC);

		return $data;
	}

	// Requête préparée
	public function prepare($parametre, $attributs = array())
	{
		$query  = explode(" ", $parametre);
		// Récupération du 1èr mot
		$option = strtolower(array_shift($query));

		$req = $this->getPDO()->prepare($parametre);
		$req->execute($attributs);

		if ($option == "select" )
		{

			if ($req->rowCount() > 0) {
				$data = $req->fetchAll(PDO::FETCH_CLASS);
				return $data;
			}

		} elseif ($option == "insert" || $option == "update" || $option == "delete") {

			if ($option == "insert") {
				// Valeur id inséré
				return $this->getPDO()->lastInsertId();
			} else {
				return $req->rowCount();
			}

		}
	}

	// Une seule ligne
	public function row($parametre, $attributs = array())
	{
		$req = $this->getPDO()->prepare($parametre);
		$req->execute($attributs);
		$data = $req->fetch(PDO::FETCH_ASSOC);

		return $data;
	}




}



// modele.php








?>
