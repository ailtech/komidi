<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 24/05/17
 * Time: 10:21
 */

//importation de la class a tester
require_once 'db.class.php';

/**
 * Class testdb TestUnitaire sur objet db
 * @author Alexandre
 */

class testdb extends PHPUnit_Framework_TestCase{

    /**
     * Variable utiliser pour contenir la bdd.
     * @var db PDO $db Variable qui va contenir la connexion
     */
    public $db;

    /**
     * Le constructeur permet d'instancier l'objet sur le quel on va faire des test
     * testdb constructeur.
     */
    function testdb(){

        //instanciation de l'objet de test
        $this->db = new db();
    }

    /**
     * Methode pour tester la connection elle doit tester la nullite
     */
    public function testDbConnectionNotNull(){

        $this->assertNotNull( $this->db->getCo(),"**retour non null**" );
    }

}