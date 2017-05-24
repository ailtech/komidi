<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 24/05/17
 * Time: 11:09
 */
require_once 'db.class.php';
require_once 'komidi.class.php';

class testkomidi extends PHPUnit_Framework_TestCase
{

    public $komidi;

    function testkomidi()
    {

        $this->komidi = new Komidi();
    }

    public function testTypeRetourObjet()
    {
        $this->assertEquals( is_object( $this->komidi->requeteObjet("SELECT * FROM kdi_spectacle") ),true,"test objet");
    }

    public function testTypeRetourArray()
    {
        $this->assertEquals( is_array( $this->komidi->requeteArray("SELECT * FROM kdi_spectacle") ),true,"test array");
    }


    public function testGetSpectacles()
    {
        $this->assertEquals( is_array( $this->komidi->getSpectacles() ),true,"test spectacle");
    }

    public function testverifConnectionUtilisateur()
    {
        $this->assertEquals($this->komidi->verifConnection( "robert@gmail.com", md5("azerty") ), "u", "test connection utilisateur");
    }

    public function testverifConnectionAdmin()
    {
        $this->assertEquals($this->komidi->verifConnection( "alex@gmail.com", md5("azerty") ), "a", "test connection administrateur");
    }

    public function testverifConnectionerreur()
    {
        $this->assertEquals($this->komidi->verifConnection( "robert@gmail.com", md5("impossibleDeMeTrouver") ), "e", "test connection erreur");
    }


}