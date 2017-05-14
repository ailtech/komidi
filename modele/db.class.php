<?php
/**
 * Class db connection a une base de donnée
 * @author Alexandre
 * @since 25/10/16
 * @version 1
 */
Class db
{
    /**
     * Attribut désignant le SGBD que l'on va utiliser, par défault le SGBD est mysql.
     * @var string $SGBDR SGBD utiliser.
     */
    private $SGBDR = "mysql";

    /**
     * Attribut désignant l'hote/serveur ou se trouve la BDD.
     * @var string $HOTE Adresse serveur base de donnée.
     */
    private $HOTE = "localhost";

    /**
     * Attribut désignant le port utiliser par le serveur par défault le port est 3306.
     * @var string $PORT port utiliser sur le serveur pour l'écoute.
     */
    private $PORT = "3306";

    /**
     * Attribut désignant la base de donnée à utilisée.
     * @var string $BDD Base de donnée à utilisée.
     */
    private $BDD = "db_komidi";

    /**
     * Attribut désignant l'utilisateur a utilisée pour la connection à la BDD.
     * @var string $USER Utilisateur BDD.
     */
    private $USER = "root";

    /**
     * Attribut désignant le mot de passe pour la connection à la base de donnée.
     * @var string $MDP Mot de passe BDD.
     */
    private $MDP = "root";

    /**
     * Attribut permettant de récupérer la concaténation de la requete de demande de connection à la BDD.
     * @var string $DSN Attribut de concaténation.
     */
    private $DSN;

    /**
     * Attribut désignant les option de connection a ajouter.
     * @var array $dboptions Option de connection.
     */
    private $dboptions = array(
        PDO::ATTR_PERSISTENT => FALSE,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",);

    /**
     * Attribut désignant le ticket de connection à la BDD.
     * @var PDO $db Connection à la BDD.
     */
    private $db;

    /**
     * Constructeur de la classe db.
     */
    function __construct()
    {
        $this->DSN = $this->SGBDR.":host=".$this->HOTE.";dbname=".$this->BDD;
        try
        {

            $this->db = new PDO($this->DSN, $this->USER, $this->MDP, $this->dboptions);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }

    /**
     * Getteur pour récupérer la connection.
     * @see db::$db
     * @return PDO Connection à la base de donnée.
     */
    public function getCo()
    {
        return $this->db;
    }

}