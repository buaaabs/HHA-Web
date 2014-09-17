<?php
/* 
* @Author: sxf
* @Date:   2014-08-25 20:32:46
* @Last Modified by:   sxf
* @Last Modified time: 2014-09-17 23:15:17
*/

use Phalcon\Events\Event,
        Phalcon\Mvc\User\Plugin,
        Phalcon\Mvc\Dispatcher,
        Phalcon\Acl;

/**
* Acl for user
*/
class Security extends Plugin
{
	public $acl = null;
	private $acl_path = "app/security/acl.data";
	private $isInitDone = false;

	// 验证是否登陆
	public function Login()
	{
		if ($this->session->isStarted() && $this->session->has("user")) {
			$user =$this->session->get('user');
		} else {
			throw new Exception('用户未登录', 103);
		}
		return $user;
	}

	public function Auth($role,$controller,$action)
	{
    	$allowed = $this->acl->isAllowed($role, $controller, $action);
    	if ($allowed != Acl::ALLOW) {
    		return false;
    	}
    	return true;
	}

	public function CheckAuth($group_id,$controller,$action)
	{
		try {
			$user = Login();
			$user = $this->session->get('user');
    		$group_id = $user['auth_group'];
		} catch (Exception $e) {
			if (!Auth($group_id,$controller,$action))
				throw $e;
		}

		if (!Auth($group_id,$controller,$action))
			throw new Exception('权限不足', 104);
	}


	public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
    	if (!$this->isInitDone) {
    		init($this->acl_path);
    		$this->isInitDone = true;
    	}
    	$controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
    	$group_id = 0;

    	try {
    		CheckAuth($group_id,$controller,$action);
    	} catch (Exception $e) {
    		$ans = [];
            Utils::makeError($e, $ans);
            echo json_encode($ans);
            //Returning "false" we tell to the dispatcher to stop the current operation
        	return false;
    	}
	}

	public function clearTemp()
	{
		unlink($this->acl_path);
	}

	function adding()
	{
		//找到并添加所有角色，例如管理员，游客，用户等
		$auth_groups = AuthGroup::find();
		foreach ($auth_groups as $group) {
			$this->acl->addRole(new Phalcon\Acl\Role($group->name));
		}

		//添加访问控制资源
		$auth_names = AuthName::find();
		foreach ($auth_names as $auth_name) {
			$pname = explode('-',$auth_name->name);
			$this->acl->addResource($pname[0],$pname[1]);
		}

		//定义访问控制
		$maps = $AuthMap::find();
		foreach ($maps as $map) {
			$pname = explode('-',$map->auth_name);
			$this->acl->allow($map->auth_group,$pname[0],$pname[1]);
		}
	}

	function init($path)
	{
		//Check whether acl data already exist
		if (!is_file($path)) {

		    $this->acl = new \Phalcon\Acl\Adapter\Memory();
		    $this->acl->setDefaultAction(Phalcon\Acl::DENY);

		    //... Define roles, resources, access, etc
		    $this->adding();

		    // Store serialized list into plain file
		    file_put_contents($path, serialize($this->acl));

		} else {

		     //Restore acl object from serialized file
		     $this->acl = unserialize(file_get_contents($path));
		}
	}
}


?>
