<?php
/**
 * Created by PhpStorm.
 * User: lilelr
 * Date: 8/21/14
 * Time: 1:26 PM
 */

require_once('simpletest/autorun.php');
require_once('simpletest/web_tester.php');


class TestOfAddSection extends WebTestCase{


   function testaddSection(){
       $this->setConnectionTimeout(3000);
       $res=$this->post('http://localhost:81/HHA-Web/Section/addSection',['name'=>'张书涛日记']);
       $ans=json_decode($res);
       $this->assertTrue($ans['id']!=-1);
       $this->showText();
   }

    
}

?>