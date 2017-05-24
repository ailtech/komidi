<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 24/05/17
 * Time: 10:45
 */
require_once 'db.class.php';
require_once 'mail.class.php';

class testmail extends PHPUnit_Framework_TestCase{

    public $mail;

    function testmail(){

        //header que l'on va utiliser
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: testUnitaire testmail.class.php'. "\r\n";
        //***************
        $this->mail = new Mail("lefevre451@gmail.com","Contact Komidi","testPhpUnit",$headers);


    }

    public function testMailEnvoye(){
        $this->assertEquals($this->mail->envoyeMail( "Monsieur", "TestUnitaire", "TestUnitaire","Saint-Louis", "97450", "lefevre451@gmail.com" ),true);
    }

}