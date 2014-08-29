<?php
/**
 * Created by PhpStorm.
 * User: lilelr
 * Date: 8/28/14
 * Time: 9:37 AM
 */

require_once('simpletest/autorun.php');
require_once('simpletest/web_tester.php');

class TestOfSysMessageController extends WebTestCase{
    public function testsend(){
        $this->setConnectionTimeout(3000);
        $res = $this->post('http://localhost:81/HHA-Web/SysMessage/sendSysMessage',['auth-group'=>array('2'),'data'=>'系统消息测试第一次','title'=>'hello']);

        $ans = json_decode($res);
        $this->assertTrue($ans['ret'] == -1);
//         $this->assertTrue($ans['title'] == 'er');
        $this->showText($ans['data']);


    }
}
