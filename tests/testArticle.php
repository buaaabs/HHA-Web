<?php
/**
 * Created by PhpStorm.
 * User: lilelr
 * Date: 8/22/14
 * Time: 7:22 PM
 */

require_once('simpletest/autorun.php');
require_once('simpletest/web_tester.php');

class TestOfArticle extends WebTestCase
{


//   public  function  testadd()
//    {
//        $this->setConnectionTimeout(3000);
//        $res = $this->post('http://localhost:81/HHA-Web/Article/add', ['title' => '明天会更好', 'author'=>'2', 'body' => '你好，中国\n你好，李乐乐','section_id'=>'3']);
//
//        $ans = json_decode($res);
//        $this->assertTrue($ans['ret'] != -1);
//        $this->showText();
//    }


//    public function testchange(){
//
//        $this->setConnectionTimeout(3000);
//        $res = $this->post('http://localhost:81/HHA-Web/Article/change/1', ['title' => '更改后的内容', 'author'=>'2', 'date'=>'20140827','body' => '你好，中国\\n你好，明天','section_id'=>'3']);
//
//        $ans = json_decode($res);
//        $this->assertTrue($ans['ret'] == 0);
//        $this->showText();
//    }


//    public function testdelete(){
//        $this->setConnectionTimeout(3000);
////        $res = $this->post('http://localhost:81/HHA-Web/Article/delete', ['title' => array('更改后的内容'),'id'=>array('1')]);
//        $res = $this->post('http://localhost:81/HHA-Web/Article/delete', ['title' => array('吸烟有害健康','饭后跑步的好处'),'id'=>array('2','3')]);
//
//        $ans = json_decode($res);
//        $this->assertTrue($ans['ret'] == 0);
//        $this->showText();
//    }

     public function testget(){

         $this->setConnectionTimeout(3000);
         $res = $this->post('http://localhost:81/HHA-Web/Article/get/1');

         $ans = json_decode($res);
         $this->assertTrue($ans['ret'] == 2);
//         $this->assertTrue($ans['title'] == 'er');
         $this->showText($ans['data']);
     }
}