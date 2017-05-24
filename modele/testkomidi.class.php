<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 24/05/17
 * Time: 11:09
 */
//instantion des class a tester
require_once 'db.class.php';
require_once 'komidi.class.php';

/**
 * Class testkomidi TestUnitaire Sur classe komidi
 * @author Alexandre
 */
class testkomidi extends PHPUnit_Framework_TestCase
{
    /**
     * @var Komidi Komidi $komidi déclaration variable pour contenir la classe a tester
     */
    public $komidi;

    /**
     * testkomidi constructeur.
     */
    function testkomidi()
    {
        //instance de la class a tester
        $this->komidi = new Komidi();
    }

    /**
     *  Methode de test pour le type que retourne la methode
     */
    public function testTypeRetourObjet()
    {
        $this->assertEquals( is_object( $this->komidi->requeteObjet("SELECT * FROM kdi_spectacle") ),true,"test objet");
    }

    /**
     * Methode de test pour le type que retourne la methode
     */
    public function testTypeRetourArray()
    {
        $this->assertEquals( is_array( $this->komidi->requeteArray("SELECT * FROM kdi_spectacle") ),true,"test array");
    }

    /**
     *  Methode de test pour le type que retourne la methode
     */
    public function testGetSpectacles()
    {
        $this->assertEquals( is_array( $this->komidi->getSpectacles() ),true,"test spectacle");
    }

    /**
     * Methode de test pour verifier si c'est u le retour
     */
    public function testverifConnectionUtilisateur()
    {
        $this->assertEquals($this->komidi->verifConnection( "robert@gmail.com", md5("azerty") ), "u", "test connection utilisateur");
    }

    /**
     * Methode de test pour verifier si c'est a le retour
     */
    public function testverifConnectionAdmin()
    {
        $this->assertEquals($this->komidi->verifConnection( "alex@gmail.com", md5("azerty") ), "a", "test connection administrateur");
    }

    /**
     * Methode de test pour verifier si c'est e le retour
     */
    public function testverifConnectionerreur()
    {
        $this->assertEquals($this->komidi->verifConnection( "robert@gmail.com", md5("impossibleDeMeTrouver") ), "e", "test connection erreur");
    }


}