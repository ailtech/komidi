<?php

/**
 * Class Komidi qui hérite de la classe db
 * @author Alexandre
 * @since 25/10/16
 * @version 2
 */
class Komidi extends db
{
    /**
     * Constructeur de komidi, ON fait appelle au constructeur mére pour benificier de la connection à la BDD.
     *
     */
    function Komidi()
    {
        //on fait appelle au constructeur mére pour disposer de la connection a la bdd
        parent::__construct();
    }

    /**
     * Méthode qui lance un effectue une requête passer en paramétre et renvoie le résultat sous forme d'objet PDO.
     * @param string $str Requête à effectuée.
     * @return PDOStatement
     */
    public function requeteObjet($str)
    {
        //On prépare la requête.
        $req = $this->getCo()->prepare($str);
        //On execute la requête.
        $req->execute();
        //On retourne le résultat de la requête
        return $req;
    }

    /**
     * Méthode qui lance un effectue une requête passer en paramétre et renvoie le résultat sous forme d'array.
     * @param string $str Requête à effectuée.
     * @return mixed
     */
    public function requeteArray($str)
    {
        //On prépare la requête.
        $req = $this->getCo()->prepare($str);
        //On l'execute.
        $req->execute();
        //On l'extrait sous forme de tableau associatif.
        $rst = $req->fetch(PDO::FETCH_ASSOC);
        //On retourne le résultat de la requête.
        return $rst;
    }

    /**
     * Méthode qui retourne tout les spectacles.
     * @see Komidi::requeteArray()
     * @return mixed
     */
    public function getSpectacles()
    {
        // On écrit la requête.
        $requete = "SELECT * FROM db_komidi ";
        //On exécute la requête et retourne son résultat.
        return $this->requeteArray( $requete );
    }

    /**
     * On récupére l'adresse email du personne.
     * @see Komidi::requeteArray()
     * @param string $req Requête a effectuée.
     * @return mixed Retourne une adresse email.
     */
    public function getEmail($req)
    {
        //On exécute la requête et retourne son résultat.
        return $this->requeteArray( $req );
    }

    /**
     * Ajoute un nouveau membres lors d'une demande d'inscription
     * @param string $req Requête d'ajout d'un membres aves les information requis.
     */
    public function setMembre($req)
    {
        //On exécute la requête et retourne son résultat.
        $this->requeteObjet( $req );
    }

    /**
     * Récupére la note moyenne attribuée à un spectacle.
     * @see Komidi::requeteArray()
     * @param int $id l'identifiant du specatacle.
     * @return mixed
     */
    public function getVueNote($id)
    {
        //On écrit la requête.
        $requete = "SELECT * FROM kdi_listenbNote_Moyenne WHERE Spe_id=$id;";
        //On exécute la requête et retourne son résultat.
        return $this->requeteArray( $requete );
    }

    /**
     * Récupére la liste des 5 meilleurs spectacles
     * @see Komidi::requeteObjet()
     * @return PDOStatement Liste des 5 meilleurs spectacles.
     */
    public function get5Spectacle()
    {
        //On écrit la requête
        $requete = "SELECT Spe_titre,K.Spe_id FROM kdi_spectacle K, cinqBestSpectacle C WHERE C.Spe_id = K.spe_id;";
        //On exécute la requête et retourne son résultat.
        return $this->requeteObjet( $requete );

    }

    /**
     * Permet de vérifier si un membres existe dans la BDD en retournant comme valeur 1 pour existe et 0 pour existe pas.
     * @param int $idMembre L'identifiant d'un membres.
     * @see Komidi::requeteObjet()
     * @return int Retourne 1 pour existe et 0 pour non existant.
     */
    public function verifMembre($idMembre)
    {
        //On écrit la requête.
        $requete = "SELECT mem_id FROM menbres WHERE mem_id = $idMembre;";
        //On exécute la requête et retourne son résultat.
        return $this->requeteObjet( $requete )->rowCount();
    }

    /**
     * Fait une recherche de spectacle selon le titre, les acteurs et le genre.
     * @param string $texte Texte sur lequel ont effetue la recherche.
     * @return PDOStatement Résultat de la recherche.
     * @see Komidi::requeteObjet()
     */
    public function recherche($texte)
    {
        //On écrit la requête.
        $requete = "SELECT Spe_titre,Spe_id,Spe_affiche,Spe_genre FROM kdi_spectacle WHERE Spe_titre LIKE \"%$texte%\" OR Spe_acteur LIKE \"%$texte%\" OR Spe_genre LIKE \"$texte%\" ;";
        //On exécute la requête et retourne son résultat.
        return $this->requeteObjet( $requete );
    }

    /**
     * Vérifie si un spectacle existe dans la BDD.
     * @param int $idSpectacle L'identifiant du spectacle.
     * @return int Retourne 1 pour existe et 0 pou non existant.
     * @see Komidi::requeteObjet()
     */
    public function verifSpectacle($idSpectacle)
    {
        //On écrit la requête
        $requete = "SELECT Spe_id FROM kdi_spectacle WHERE Spe_id = $idSpectacle;";
        //On exécute la requête et retourne son résultat.
        return $this->requeteObjet( $requete )->rowCount();
    }

    /**
     * On vérifie si la personne existe et quelle est sont statut pour ce connecter.
     * @see Komidi::requeteObjet()
     * @see Komidi::requeteArray()
     * @param string $email Email de la personne.
     * @param string $mdp Mot de passe de la personne.
     * @return string Retourne u dans le cas ou c'est un utilisateur.
     * @return string a dans le cas ou c'est un administrateur.
     * @return string e dans les cas ou il y a eu une erreur et que le mot de passe et l'email ne correspond pas.
     */
    public function verifConnection($email,$mdp)
    {
        //On écrit la requête.
        $requete = "SELECT mem_email,mem_pass,mem_statut FROM menbres WHERE mem_email = \"$email\" AND mem_pass = \"$mdp\";";
        //On exécute la requête et vérifie si la personne existe et que le mot de passe et l'email est conforme.
        if( $this->requeteObjet( $requete )->rowCount() == 1 )
        {
            //On exécute la requête et enregistre dans une variable
            $edit=$this->requeteArray( $requete );
            //On vérifie quelle est sont statut pour la redirigé.
            if( $edit['mem_statut'] == 0 )// 0 pour utilisateur l'ambda
            {
                return "u";//utilisateur
            }
            else if( $edit['mem_statut'] == 1 )//1 pour administrateur
            {
                return "a";//admin
            }
            else
            {
                return "e";//erreur
            }
        }
        else if( $this->requeteObjet( $requete )->rowCount() == 0 )//On exécute la requête et verifie si l'email et le mot de passe n'est pas conforme.
        {
            return "e";// email et mdp ne corresponde pas
        }
        else
        {
            return "e";//erreur
        }

    }

    /**
     * Récupére toute les informations sur un Utilisateur.
     * @param string $mail L'email de la personne.
     * @param string $mdp Mot de passe de la personne.
     * @return mixed Retourne le résultat de la requête.
     * @see Komidi::requeteArray()
     */
    public function getUtilisateur($mail,$mdp)
    {
        //On écrit la requête.
        $requete = "SELECT * FROM menbres WHERE mem_email = \"$mail\" AND mem_pass = \"$mdp\";";
        //On exécute la requête et retourne son résultat.
        return $this->requeteArray( $requete );
    }

    /**
     * Vérifie si un membre a déja donnée une note à un spectacle.
     * @param int $idMembre L'identifiant du membre.
     * @param int $idSpectacle L'identifiant du spectacle.
     * @return int Retourne 1 pour oui il a déja notée, et 0 pour non il n'a pas encore notée.
     * @see Komidi::requeteObjet()
     */
    public function verifNoter($idMembre,$idSpectacle)
    {
        //faire envoyer la variable id membres de sessio aussi pour verifier si la personne ne tente ppas une usurpation d' id membres
        //On écrit la requête.
        $requete = "SELECT mem_id,Spe_id FROM noter WHERE mem_id =$idMembre  AND Spe_id = $idSpectacle;";
        //On exécute la requête et retourne son résultat.
        return $this->requeteObjet( $requete )->rowCount();
    }

    /**
     * Enregistre le vote d'un membre sur un spectacle.
     * @param int $idMembre L'identifiant d'un membre
     * @param int $idSpectacle L'identifiant d'un Spectacle
     * @param int $note La note donnée par le membres allant de 0 à 5.
     * @return string Retourne 0 lorsque le vote n'est pas possible, et 1 lorsque le vote a étè pris en compte.
     * @see Komidi::requeteObjet()
     * @see Komidi::verifNoter()
     * @see Komidi::verifMembre()
     * @see Komidi::verifSpectacle()
     */
    //enregistre le vote de la personne
    public function noter($idMembre,$idSpectacle,$note)
    {
        //echo $this->verifNoter($idMembre,$idSpectacle).";".$this->verifMembre($idMembre).";".$this->verifSpectacle($idSpectacle);
        //On vérifie que la personne n'a pas déja voter sur ce spectacle, que le membres existe et que le spectacle existe.
        if( $this->verifNoter($idMembre,$idSpectacle) == 1 or $this->verifMembre($idMembre) == 0 or $this->verifSpectacle($idSpectacle) == 0)
        {
            return "0";//on retourne 0 note impossible
        }
        else
        {
            //On écrit la requête.
            $requete = "INSERT INTO noter VALUES($idMembre,$idSpectacle,$note);";
            //On exécute la requête.
            if( $this->requeteObjet( $requete ) )
            {
                return "1";//on retourne 1 note possible
            }
            else
            {
                return "0";//on retourne 0 note impossible
            }

        }


    }

    /**
     * Récupéres toute les informations sur un spectacle.
     * @param int $id L'identifiant d'un spectacle.
     * @return mixed Retourne le résultat de la requête.
     * @see Komidi::requeteArray()
     */
    public function getSpectacle($id)//recupere les info lier a un spectacle
    {
        //On écrit la requête.
        $requete = "SELECT Spe_id, Spe_titre, Spe_mes, Spe_genre,Spe_Lang, Spe_resume_court, Spe_affiche, Spe_public, Spe_duree, Spe_resume_long FROM kdi_spectacle WHERE Spe_id=".$id.";";
        //On exécute la requête et retourne son résultat.
        return $this->requeteArray( $requete );
    }

    /**
     * Affichage des spectacles
     * @param string $query Requête qui va sélectioner les informations voulue sur les spectacles.
     * @see Komidi::requeteObjet()
     */
    public function dataview($query)
    {
        //On exécute la requête et l'enregistre dans une variable.
        $stmt = $this->requeteObjet($query);

        // si la requête renvoie au moin 1 élément.
        if($stmt->rowCount() > 0)
        {
            //On extraits les données dans une boucle.
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

    /**
     * Renvoye la requête à utiliser pour faire une pagination aprés avoir fait les calcul des pages selon le nombre d'éléments voulue par page.
     * @param string $query Requête que l'on veux effectuer.
     * @param int $records_per_page Le nombre d'éléments a afficher par page.
     * @return string Retourne la requête permettant de faire une pagination.
     */
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

    /**
     * Affiche la barre de pagination.
     * @param string $query La requête de pagination.
     * @param int $records_per_page Le nombre d'eléments par page.
     */
    public function paginglink($query,$records_per_page)
    {

        $self = $_SERVER['PHP_SELF'];

        $stmt = $this->getCo()->prepare($query);
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



}