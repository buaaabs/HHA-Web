<?php
/* 
* @Author: sxf
* @Date:   2014-08-08 14:36:04
* @Last Modified by:   sxf
* @Last Modified time: 2014-08-08 15:51:59
*/


/**
*  提供账户注册，登陆，验证，等基础方法的类
*/
class Accout
{
	
	//登陆验证，返回0成功，1是密码错误，2是用户名找不到
	public static function loginVerify($username,$password)
	{
		$user = find_by_name($username);

		if ($user <> null)
		{
			if ($user->password == $password)
			{
				$_SESSION['user'] = $user;
				return 0;
			}
			else return 1;
		} else return 2; 
	}

	

	//检验用户名是否存在，存在则返回1，否则返回0
	public static function userexistVerify($username)
	{
		$user = find_by_name($username);
		if ($user <> null) return 1;
		else return 0;
	}


	public static function find_by_name($username)
	{
		$conditions = "username = :name:";
		$parameters = array(
		    "name" => $username
		);

		$user = User::findFirst(array(
		    $conditions,
		    "bind" => $parameters
		));

		return $user;
	}

}


?>
