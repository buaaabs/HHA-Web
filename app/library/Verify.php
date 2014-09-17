<?php
/* 
* @Author: sxf
* @Date:   2014-08-27 13:40:49
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-17 22:29:43
*/

/**
* 
*/
class Verify extends Plugin
{
	

	public function checkAuth($group,$auth_id)
	{

	}

	public function Auth($authname)
	{
		$auth_group = 0;
		try {
			$user_id = Login();
			$auth_group = $this->session->get('user')['auth_group'];
		} catch (Exception $e) {
			
		} 
	}
}

?>
