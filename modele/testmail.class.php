<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 24/05/17
 * Time: 10:45
 */

// class necessaire pour realiser teste unitaire
require_once 'db.class.php';
require_once 'mail.class.php';

/**
 * Class testmail TestUnitaire sur la class mail
 * @author Alexandre
 */
class testmail extends PHPUnit_Framework_TestCase{

    /**
     * @var Mail Mail $mail déclaration variable pour contenir objet mail pour realiser les test
     */
    public $mail;

    /**
     * testmail constructeur.
     */
    function testmail(){

        //header que l'on va utiliser
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: testUnitaire testmail.class.php'. "\r\n";
        //instanciation objet Mail
        $this->mail = new Mail("lefevre451@gmail.com","Contact Komidi","testPhpUnit",$headers);


    }

    /**
     * Methode de testEnvoyeMail
     */
    public function testMailEnvoye(){
        $this->assertEquals($this->mail->envoyeMail( "Monsieur", "TestUnitaire", "TestUnitaire","Saint-Louis", "97450", "lefevre451@gmail.com" ),true);
    }

}