<?php
/* 
* @Author: sxf
* @Date:   2014-08-19 16:07:23
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-21 15:51:09
*/

require_once('simpletest/autorun.php');
require_once('simpletest/web_tester.php');

class AuthApiTest extends WebTestCase {

	public function PtestSignup() { 
		$this->setConnectionTimeout(300);        
		$ret = $this->post('http://localhost:8888/HHA-Web/AuthApi/signup',
			[
				'username' => 'sun_test'.rand(),
				'password' => '123456'
			]);
		$obj = json_decode($ret);
		$this->assertTrue($obj['id']!=-1);
		$this->showText();
	}

	public function testLogin()
	{
		$this->setConnectionTimeout(300);        
		$ret = $this->post('http://localhost:8888/HHA-Web/AuthApi/login',
			[
				'username' => 'sun_test13006',
				'password' => '123456'
			]);
		$obj = json_decode($ret);
		$this->assertTrue($obj['id']!=-1);
		$this->showText();
	}
}

?>
