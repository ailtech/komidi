<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 24/05/17
 * Time: 10:21
 */
require_once 'db.class.php';

class testdb extends PHPUnit_Framework_TestCase{

    public $db;

    function testdb(){
        $this->db = new db();
    }

    public function testDbConnectionNotNull(){
        $this->assertNotNull( $this->db->getCo(),"**retour non null**" );
    }

}