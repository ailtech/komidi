<?php
class Spectacle
{
	private $db;
	
	function __construct($DB_cnx)
	{
		$this->db = $DB_cnx;
	}

	public function getSpectacles()
	{	$strSql = "SELECT * FROM kdi_spectacle;";
		$stmt = $this->db->prepare($strSql);
		$stmt->execute();
		return $stmt;
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

		$strSQL= "SELECT * FROM kdi_spectacle WHERE Spe_id=".$id.";";
		$stmt = $this->db->prepare($strSQL);
		$stmt->execute();
		//$edit=$stmt->fetch(PDO::FETCH_ASSOC);
        //$note = $this->getVueNote($id);
		return $stmt;
	}
	
	
	public function updateSpectacle($Titre,$Spe_mes,$Acteurs,$Spe_cie,$Duree,$Langue,$Public,/*$Affiche,*/$ResumeCourt,$ResumeLong,$Genre,$idSpectacle)
	{
		//il manque l affiche
		$strSql = "UPDATE kdi_spectacle 
SET Spe_titre=\"$Titre\",Spe_mes=\"$Spe_mes\",Spe_acteur=\"$Acteurs\",Spe_cie=\"$Spe_cie\",Spe_genre=\"$Genre\",Spe_duree=$Duree,Spe_Lang=\"$Langue\",Spe_public=\"$Public\",Spe_resume_court=\"$ResumeCourt\",Spe_resume_long=\"$ResumeLong\" WHERE Spe_id=$idSpectacle;";
		//echo $strSql; //debug
		$stmt = $this->db->prepare($strSql);
		$stmt->execute();
		return $stmt;
	}
	
	public function deleteSpectacle($id)
	{
		$strSQL= "DELETE FROM kdi_spectacle WHERE Spe_id=$id;";
		$stmt = $this->db->prepare($strSQL);
		$stmt->execute();
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
		$this->db_pass = "root";
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
