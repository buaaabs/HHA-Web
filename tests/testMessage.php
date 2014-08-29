<?php
/**
 * Created by PhpStorm.
 * User: lilelr
 * Date: 8/28/14
 * Time: 9:08 AM
 */
require_once('simpletest/autorun.php');
require_once('simpletest/web_tester.php');

class TestOfMessageController extends WebTestCase{
//    public function testsendSysMessage(){
//        $this->setConnectionTimeout(3000);
//        $res = $this->post('http://localhost:81/HHA-Web/SysMessage/sendSysMessage',['to_id'=>array('2'),'data'=>'测试第三次','title'=>'hello']);
//
//        $ans = json_decode($res);
//        $this->assertTrue($ans['ret'] == '-1');
////         $this->assertTrue($ans['title'] == 'er');
//        $this->showText($ans['data']);
//
//
//    }

//    public function testget(){
//        $this->setConnectionTimeout(3000);
//        $res = $this->post('http://localhost:81/HHA-Web/Message/get/2');
//        $ans = json_decode($res);
//        $this->assertTrue($ans['ret'] == 0);
////         $this->assertTrue($ans['title'] == 'er');
//        $this->showText($ans['data']);
//
//    }

    public function testdelete(){
        $this->setConnectionTimeout(3000);
        $res = $this->post('http://localhost:81/HHA-Web/Message/delete',['ids'=>array(1,2,3)]);
        $ans = json_decode($res);
        $this->assertTrue($ans['ret'] == 0);
//         $this->assertTrue($ans['title'] == 'er');
        $this->showText($ans);
    }
}
